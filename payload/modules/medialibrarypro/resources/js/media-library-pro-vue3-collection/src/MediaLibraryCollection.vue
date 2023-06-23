<template>
    <media-library-renderless
        ref="mediaLibraryRenderless"
        :initial-value="initialValue"
        :validation-errors="validationErrors"
        :route-prefix="routePrefix"
        :validation-rules="validationRules"
        :translations="translations"
        :before-upload="beforeUpload"
        :after-upload="afterUpload"
        :name="name"
        :max-items="computedMaxItems"
        :max-size-for-preview-in-bytes="maxSizeForPreviewInBytes"
        :vapor="vapor"
        :vapor-signed-storage-url="vaporSignedStorageUrl"
        :upload-domain="uploadDomain"
        :with-credentials="withCredentials"
        :headers="headers"
        @changed="$emit('change', $event)"
        @is-ready-to-submit-change="$emit('is-ready-to-submit-change', $event)"
        @has-uploads-in-progress-change="$emit('has-uploads-in-progress-change', $event)"
        v-slot="{
            state,
            removeMedia,
            getImgProps,
            getCustomPropertyInputProps,
            getCustomPropertyInputListeners,
            getCustomPropertyInputErrors,
            getNameInputProps,
            getNameInputListeners,
            getNameInputErrors,
            getDropZoneProps,
            getDropZoneListeners,
            getFileInputProps,
            getFileInputListeners,
            replaceMedia,
            getErrors,
            clearObjectErrors,
            clearInvalidMedia,
        }"
    >
        <icons />

        <div
            :class="`media-library media-library-multiple ${
                state.media.length == 0 ? 'media-library-empty' : 'media-library-filled'
            } ${sortable && 'media-library-sortable'}`"
        >
            <list-errors
                :invalid-media="state.invalidMedia"
                :top-level-errors="validationErrors[name]"
                @cleared="clearInvalidMedia()"
            />

            <component
                :is="sortable ? 'draggable' : 'div'"
                :list="state.media"
                v-show="state.media && state.media.length"
                class="media-library-items"
                handle=".dragula-handle"
                @update="handleSortEnd"
            >
                <div
                    v-for="object in state.media"
                    class="media-library-item media-library-item-row"
                    :data-media-library-uuid="object.attributes.uuid"
                >
                    <div v-if="sortable" class="dragula-handle media-library-row-drag">
                        <icon v-if="state.media.length" icon="drag" />
                    </div>

                    <thumb
                        :uploadInfo="object.upload"
                        :validation-rules="validationRules"
                        :img-props="getImgProps(object)"
                        @replaced="replaceMedia(object, $event)"
                    />

                    <item-errors
                        v-if="getErrors(object).length"
                        :object-errors="getErrors(object)"
                        @back="clearObjectErrors(object)"
                    />

                    <template v-else>
                        <slot name="properties" :object="object">
                            <div class="media-library-properties media-library-properties-fixed">
                                <div v-if="object.attributes.extension" class="media-library-property">
                                    {{ object.attributes.extension.toUpperCase() }}
                                </div>

                                <div v-if="object.attributes.size" class="media-library-property">
                                    {{ (object.attributes.size / 1024).toFixed(2) }} KB
                                </div>

                                <div v-if="object.attributes.original_url" class="media-library-property">
                                    <a
                                        :href="object.attributes.original_url"
                                        download
                                        target="_blank"
                                        class="media-library-text-link"
                                    >
                                        {{ window.mediaLibraryTranslations.download }}
                                    </a>
                                </div>
                            </div>
                        </slot>

                        <slot
                            name="fields"
                            :object="object"
                            :getCustomPropertyInputProps="
                                (propertyName) => getCustomPropertyInputProps(object, propertyName)
                            "
                            :getCustomPropertyInputListeners="
                                (propertyName) => getCustomPropertyInputListeners(object, propertyName)
                            "
                            :getCustomPropertyInputErrors="
                                (propertyName) => getCustomPropertyInputErrors(object, propertyName)
                            "
                            :getNameInputProps="() => getNameInputProps(object)"
                            :getNameInputListeners="() => getNameInputListeners(object)"
                            :getNameInputErrors="() => getNameInputErrors(object)"
                        >
                            <div class="media-library-properties">
                                <div class="media-library-field">
                                    <label class="media-library-label">
                                        {{ window.mediaLibraryTranslations.name }}
                                    </label>
                                    <input
                                        class="media-library-input"
                                        v-bind="getNameInputProps(object)"
                                        v-on="getNameInputListeners(object)"
                                        dusk="media-library-field-name"
                                    />

                                    <p v-for="error in getNameInputErrors(object)" class="media-library-field-error">
                                        {{ error }}
                                    </p>
                                </div>
                            </div>
                        </slot>
                    </template>

                    <div class="media-library-row-remove" @click.stop="removeMedia(object)" dusk="remove">
                        <icon icon="remove" />
                    </div>
                </div>
            </component>

            <hidden-fields :name="name" :media-state="state.media" />

            <div v-show="!computedMaxItems || state.media.length < computedMaxItems" class="media-library-uploader">
                <uploader
                    :multiple="multiple"
                    v-bind="{ ...getDropZoneProps(), ...getFileInputProps() }"
                    v-on="{ ...getDropZoneListeners(), ...getFileInputListeners() }"
                    add
                    :file-type-help-text="fileTypeHelpText"
                />
            </div>
        </div>
    </media-library-renderless>
</template>

<script>
import { VueDraggableNext } from 'vue-draggable-next';
import {
    MediaLibraryRenderless,
    HiddenFields,
    DropZone,
    ListErrors,
    ItemErrors,
    Icons,
    Icon,
    Thumb,
    Uploader,
} from '@spatie/media-library-pro-vue3';

export default {
    props: {
        name: { required: false, type: String },
        initialValue: { required: false, type: [Array, Object] },
        validationErrors: { default: () => ({}), type: [Object, Array] },
        routePrefix: { required: false, type: String },
        translations: { default: () => {}, type: Object },
        validationRules: { required: false, type: Object },
        multiple: { default: true, type: Boolean },
        sortable: { default: true, type: Boolean },
        maxItems: { required: false, type: Number },
        maxSizeForPreviewInBytes: { required: false, type: Number },
        vapor: { required: false, type: Boolean },
        vaporSignedStorageUrl: { required: false, type: String },
        uploadDomain: { required: false, type: String },
        withCredentials: { required: false, type: Boolean },
        headers: { required: false, type: Object },
        fileTypeHelpText: { required: false, type: String },
        beforeUpload: { default: () => {}, type: Function },
        afterUpload: { default: () => {}, type: Function },
    },

    emits: [
        'change',
        'is-ready-to-submit-change',
        'has-uploads-in-progress-change',
        'isReadyToSubmitChange',
        'hasUploadsInProgressChange',
    ],

    components: {
        draggable: VueDraggableNext,
        MediaLibraryRenderless,
        HiddenFields,
        DropZone,
        ListErrors,
        ItemErrors,
        Icons,
        Icon,
        Thumb,
        Uploader,
    },

    data: () => ({
        mediaLibrary: null,
        window,
    }),

    computed: {
        computedMaxItems() {
            return this.multiple ? this.maxItems : 1;
        },
    },

    mounted() {
        this.mediaLibrary = this.$refs.mediaLibraryRenderless.mediaLibrary;
    },

    methods: {
        handleSortEnd(event) {
            this.$refs.mediaLibraryRenderless.setOrder(
                Array.from(event.from.children || []).map((element) => {
                    return element.getAttribute('data-media-library-uuid');
                }),
                false
            );
        },
    },
};
</script>
