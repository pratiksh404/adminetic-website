<template>
    <div class="media-library-thumb" dusk="thumb">
        <img
            v-if="!!imgProps.src && !imageErrored"
            v-bind="imgProps"
            class="media-library-thumb-img"
            @error="imageErrored = true"
        />

        <span v-else class="media-library-thumb-extension">
            <span class="media-library-thumb-extension-truncate">{{ imgProps.extension }}</span>
        </span>

        <uploader
            v-bind="$attrs"
            :validation-rules="validationRules"
            :add="false"
            :multiple="false"
            :upload-info="uploadInfo"
            @dropped="$emit('replaced', $event.dataTransfer.files[0])"
            @changed="$emit('replaced', $event.target.files[0])"
        />
    </div>
</template>

<script>
import Uploader from './Uploader.vue';

export default {
    props: {
        uploadInfo: { required: true, type: Object },
        validationRules: { required: false, type: Object },
        imgProps: { required: true, type: Object },
    },

    emits: ['replaced'],

    components: { Uploader },

    data: function () {
        return { imageErrored: false, oldImgSrc: this.imgProps.src };
    },

    watch: {
        imgProps: {
            deep: true,
            immediate: true,
            handler: function (val) {
                if (this.oldImgSrc != val.src) {
                    this.imageErrored = false;
                }
            },
        },
    },
};
</script>
