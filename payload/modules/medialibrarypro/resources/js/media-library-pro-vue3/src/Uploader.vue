<template>
    <drop-zone
        v-bind="$attrs"
        :validation-accept="(validationRules || {}).accept"
        :class="add ? 'media-library-add' : 'media-library-replace'"
        @clicked="$refs.fileInputRef.click()"
        @dropped="$emit('dropped', $event)"
        v-slot="{ hasDragObject, isDropTarget, isValid }"
    >
        <button
            type="button"
            :class="['media-library-dropzone', {
                'media-library-dropzone-drag': hasDragObject && !isDropTarget,
                'media-library-dropzone-drop': hasDragObject && isDropTarget,
                'media-library-dropzone-add': add,
                'media-library-dropzone-replace': !add,
                disabled: !isValid && hasDragObject,
            }]"
        >
            <input
                type="file"
                :accept="(validationRules || {}).accept ? (validationRules || {}).accept.join(',') : undefined"
                class="media-library-hidden"
                ref="fileInputRef"
                :multiple="multiple"
                @change.stop="handleChange"
                :dusk="add ? 'main-uploader' : 'uploader'"
            />

            <div class="media-library-placeholder">
                <icon-button v-if="isValid || !hasDragObject" level="info" :icon="add ? 'add' : 'replace'" />
                <icon-button v-else level="warning" icon="not-allowed" />

                <div
                    v-if="uploadInfo"
                    :class="`media-library-progress-wrap ${
                        uploadInfo.hasFinishedUploading ? '' : 'media-library-progress-wrap-loading'
                    }`"
                >
                    <progress max="100" :value="uploadInfo.uploadProgress" class="media-library-progress" />
                </div>
            </div>

            <div v-if="add" class="media-library-help">
                <template v-if="isValid && hasDragObject">
                    <span v-if="isDropTarget">{{ window.mediaLibraryTranslations.dropFile }}</span>
                    <span v-else>{{ window.mediaLibraryTranslations.dragHere }}</span>
                </template>

                <span v-else>{{ buildRuleHelpText({ validationRules, maxItems, fileTypeHelpText }) }}</span>
            </div>
        </button>
    </drop-zone>
</template>

<script>
import DropZone from './DropZone.vue';
import ItemErrors from './ItemErrors.vue';
import IconButton from './components/IconButton.vue';
import { buildRuleHelpText } from '@spatie/media-library-pro-core';

export default {
    props: {
        add: { default: true, type: Boolean },
        uploadInfo: { required: false, type: Object },
        multiple: { default: false, type: Boolean },
        validationRules: { required: false, type: Object },
        maxItems: { required: false, type: Number },
        fileTypeHelpText: { required: false, type: String },
    },

    emits: ['changed', 'dropped'],

    components: { DropZone, IconButton, ItemErrors },

    data: () => ({ window }),

    methods: {
        buildRuleHelpText,

        handleChange(event) {
            this.$emit('changed', event);

            this.$refs.fileInputRef.value = '';
        },
    },
};
</script>
