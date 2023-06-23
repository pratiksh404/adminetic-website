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
        :multiple="multiple"
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
            getImgProps,
            getNameInputProps,
            getNameInputListeners,
            getNameInputErrors,
            getCustomPropertyInputProps,
            getCustomPropertyInputListeners,
            getCustomPropertyInputErrors,
            getDropZoneProps,
            getDropZoneListeners,
            getFileInputProps,
            getFileInputListeners,
            removeMedia,
            replaceMedia,
            getErrors,
            clearObjectErrors,
            clearInvalidMedia,
        }"
    >
        <icons />

        <div
            class="media-library"
            :class="[
                multiple ? 'media-library-multiple' : 'media-library-single',
                state.media.length == 0 ? 'media-library-empty' : 'media-library-filled',
            ]"
        >
            <list-errors
                :invalid-media="state.invalidMedia"
                :top-level-errors="validationErrors[name]"
                @cleared="clearInvalidMedia()"
            />

            <div v-if="state.media && state.media.length" class="media-library-items">
                <div v-for="object in state.media" class="media-library-item">
                    <thumb
                        :uploadInfo="object.upload"
                        :validation-rules="validationRules"
                        :img-props="getImgProps(object)"
                        @replaced="replaceMedia(object, $event)"
                    />

                    <div class="media-library-properties">
                        <item-errors
                            v-if="getErrors(object).length"
                            :object-errors="getErrors(object)"
                            @back="clearObjectErrors(object)"
                        />

                        <template v-else>
                            <slot name="properties" :object="object">
                                <div v-if="object.attributes.extension" class="media-library-property">
                                    {{ object.attributes.extension.toUpperCase() }}
                                </div>

                                <div v-if="object.attributes.size" class="media-library-property">
                                    {{ (object.attributes.size / 1024).toFixed(2) }} KB
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
                            ></slot>

                            <div class="media-library-property">
                                <button
                                    type="button"
                                    class="media-library-text-link"
                                    @click.stop="removeMedia(object)"
                                    dusk="remove"
                                >
                                    {{ window.mediaLibraryTranslations.remove }}
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

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
import {
    MediaLibraryRenderless,
    HiddenFields,
    DropZone,
    ListErrors,
    ItemErrors,
    Icons,
    Thumb,
    Uploader,
} from '@spatie/media-library-pro-vue3';

export default {
    props: {
        name: { required: false, type: String },
        initialValue: { required: false, type: [Array, Object] },
        routePrefix: { required: false, type: String },
        translations: { default: () => {}, type: Object },
        validationRules: { required: false, type: Object },
        validationErrors: { default: () => ({}), type: [Object, Array] },
        multiple: { default: false, type: Boolean },
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

    emits: ['change', 'is-ready-to-submit-change', 'has-uploads-in-progress-change'],

    components: {
        MediaLibraryRenderless,
        HiddenFields,
        DropZone,
        ListErrors,
        ItemErrors,
        Icons,
        Thumb,
        Uploader,
    },

    data: () => ({ mediaLibrary: null, window }),

    mounted() {
        this.mediaLibrary = this.$refs.mediaLibraryRenderless.mediaLibrary;
    },

    computed: {
        computedMaxItems() {
            return this.multiple ? this.maxItems : 1;
        },
    },
};
</script>
