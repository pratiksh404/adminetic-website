<template>
    <div v-if="objectErrors.length > 0" class="media-library-properties">
        <span class="media-library-text-error">
            <span v-for="error in objectErrors" :key="error">{{ error }}</span>
        </span>
        <a
            class="media-library-text-link media-library-text-error media-library-help-clear"
            @click.stop="$emit('back')"
        >
            {{ window.mediaLibraryTranslations.goBack }}
        </a>
    </div>
</template>

<script>
export default {
    props: {
        objectErrors: { required: true, type: Array },
    },

    data: () => ({ window }),

    emits: ['back'],
};
</script>
