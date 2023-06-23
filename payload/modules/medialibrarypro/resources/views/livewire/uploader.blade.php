<div
    x-data="initDropZone({ _this: @this, rules: '{{ $rules }}', multiple: '{{ $multiple }}', uploadError: '{{ $uploadError }}' })"
    x-ref="element"
    @dragenter.document="handleDocumentDragenter($event)"
    @dragleave.document="handleDocumentDragleave($event)"
    @drop.document="handleDocumentDrop($event)"
    @dragover.document="handleDocumentDragOver($event, $refs.element)"
    @drop="handleDrop"
    @click="$refs.input.click()"

    class="{{ $add ? 'media-library-add' : 'media-library-replace' }}"
>
    <button
        :disabled="!isValid"
        type="button"
        :class="{
                'media-library-dropzone-drag': hasDragObject && !isDropTarget,
                'media-library-dropzone-drop': hasDragObject && isDropTarget,
            }"
        class="media-library-dropzone {{ $add ? 'media-library-dropzone-add' : 'media-library-dropzone-replace' }}">

        <input dusk="{{ $add ? 'main-uploader' : 'uploader' }}" class="media-library-hidden" x-ref="input"
               @if($multiple) multiple @endif type="file" wire:model="upload"
               wire:key="{{ \Illuminate\Support\Str::uuid() }}"
               x-on:livewire-upload-error="console.log('upload error')"
               x-on:livewire-upload-progress="uploadProgress = $event.detail.progress"
               x-on:livewire-upload-finish="uploadCompletedSuccessfully"
        />

        <div class="media-library-placeholder">
            <x-media-library-button wire:loading.remove x-show="isValid" level="info" icon="{{ $add ? 'add' : 'replace' }}"/>
            <x-media-library-button x-show="!isValid" level="warning" icon="not-allowed"/>

            @unless($add)
            <div class="media-library-progress-wrap" wire:target="upload" wire:loading.class="media-library-progress-wrap-loading">
                <progress max="100" :value="uploadProgress" class="media-library-progress"></progress>
            </div>
            @endunless
        </div>

        @if($add)
            <div class="media-library-progress-wrap" wire:target="upload" wire:loading.class="media-library-progress-wrap-loading">
                <progress max="100" :value="uploadProgress" class="media-library-progress"></progress>
            </div>

            <div class="media-library-help" wire:loading.remove>
                <div x-show="@this.data.uploadError">
                    @if($uploadError)
                        @include('media-library::livewire.partials.item-error', ['message' => $uploadError])
                    @endif
                </div>

                <div>
                    <span x-show="isValid && hasDragObject">
                            <span x-show="!isDropTarget">{{ __('Drag file here') }}</span>
                            <span x-show="isDropTarget">{{ __('Drop file to upload') }}</span>
                    </span>
                    <span x-show="!isValid || !hasDragObject" x-text="ruleHelpText"></span>
                </div>
            </div>
        @endif

    </button>

    <script>
        window.initDropZone = function({ _this, rules, multiple, uploadError }) {
            const isValid = true;

            const hasDragObject = false;
            const isDropTarget = false;
            const uploadProgress = 0;

            const { ruleHelpText, fileTypeRules } = buildRuleHelpText(rules, undefined, multiple);

            function getFileTypeIsAllowed(fileType) {
                let checkType = fileType;

                if (checkType.includes('/')) {
                    checkType = checkType.split('/')[1];
                }

                if (!fileTypeRules.length) {
                    return true;
                }

                if (fileTypeRules.includes(checkType)) {
                    return true;
                }

                if (fileTypeRules.some((acceptType) => acceptType.endsWith('*') && checkType.includes(acceptType.replace('*', '')))) {
                    return true;
                }

                return false;
            }

            function handleDocumentDragenter(e) {
                e.preventDefault();
                this.hasDragObject = true;

                if (!e.dataTransfer.items || !e.dataTransfer.items.length) {
                    return this.isValid = true;
                }

                if (!fileTypeRules || !fileTypeRules.length) {
                    return this.isValid = true;
                }

                this.isValid = Array.from(e.dataTransfer.items).every((item) => {
                    return getFileTypeIsAllowed(item.type);
                })
            }

            function handleDocumentDragleave(e) {
                if (!e.clientX && !e.clientY) {
                    e.preventDefault();
                    this.hasDragObject = false;
                    this.isValid = true;
                }
            }

            function handleDocumentDrop(e) {
                e.preventDefault();
                this.hasDragObject = false;
                this.isValid = true;
            }

            function handleDocumentDragOver(e, element) {
                e.preventDefault();
                const overElement = element.contains(e.target);

                if (!overElement) {
                    return (this.isDropTarget = false);
                }

                this.isDropTarget = true;
            }

            function handleDrop(e) {
                e.preventDefault();

                this.isValid = true;

                const files = multiple ? e.dataTransfer.files : e.dataTransfer.files[0];

                const myArguments = ['upload', files, (uploadedFilename) => {
                    this.uploadCompletedSuccessfully();
                }, (error) => {
                    // Error callback
                    console.log('upload error', error);
                }, (event) => {
                    this.uploadProgress = event.detail.progress;
                }];

                multiple ? _this.uploadMultiple(...myArguments) : _this.upload(...myArguments);
            }

            function uploadCompletedSuccessfully() {
                if (uploadError) {
                    this.uploadError = uploadError;

                    return;
                }
            }

            return {
                hasDragObject,
                isDropTarget,
                isValid,
                handleDrop,
                handleDocumentDragenter,
                handleDocumentDragleave,
                handleDocumentDrop,
                handleDocumentDragOver,
                uploadProgress,
                uploadCompletedSuccessfully,
                ruleHelpText,
                uploadError,
            }
        }

        function addToRuleHelpText(ruleHelpText, newRule) {
            if (!newRule) {
                return ruleHelpText;
            }

            return `${ruleHelpText ? ruleHelpText + ' | ' : ''}${newRule}`;
        }

        function buildRuleHelpText(rules = '', maxItems, multiple) {
            let fileTypeRules = [];
            let fileSizeRules = { min: '', max: '' };

            rules.split('|').forEach(rule => {
                const [ruleName, ruleValue] = rule.split(':');

                if (ruleName === 'mimes') {
                    fileTypeRules = ruleValue.split(',');
                }

                if (ruleName === 'max') {
                    fileSizeRules.max = ruleValue;
                }

                if (ruleName === 'min') {
                    fileSizeRules.min = ruleValue;
                }
            });

            let ruleHelpText = '';

            ruleHelpText = addToRuleHelpText(ruleHelpText, multiple ? '{{ __('Select or drag files') }}' : '{{  __('Select or drag a file') }}');

            if (fileTypeRules) {
                const amountOfRules = fileTypeRules.length;

                ruleHelpText = addToRuleHelpText(
                    ruleHelpText,
                    fileTypeRules.reduce((ruleHelpText, rule, i) => {
                        const joiner = i === amountOfRules - 1 ? '' : ', ';

                        ruleHelpText += rule.toUpperCase() + joiner;

                        return ruleHelpText;
                    }, '')
                );
            }

            if (fileSizeRules.min) {
                const minSizeString =
                    fileSizeRules.min > 1024 ? (fileSizeRules.min / 1024).toFixed(2) + 'MB' : fileSizeRules.min + 'KB';
                ruleHelpText = addToRuleHelpText(ruleHelpText, `> ${minSizeString}`);
            }

            if (fileSizeRules.max) {
                const maxSizeString =
                    fileSizeRules.max > 1024 ? (fileSizeRules.max / 1024).toFixed(2) + 'MB' : fileSizeRules.max + 'KB';
                ruleHelpText = addToRuleHelpText(ruleHelpText, `< ${maxSizeString}`);
            }

            return { ruleHelpText, fileTypeRules };
        }
    </script>

</div>
