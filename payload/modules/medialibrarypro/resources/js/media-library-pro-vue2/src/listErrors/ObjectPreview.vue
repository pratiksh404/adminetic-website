<template>
    <span v-if="imageErrored" class="media-library-thumb-extension">
        <span class="media-library-thumb-extension-truncate">{{ name.split('.').pop() }}</span>
    </span>

    <img v-else class="media-library-thumb-img" :src="client_preview" @error="imageErrored = true" />
</template>

<script>
export default {
    props: {
        name: { default: '', type: String },
        client_preview: { default: '', type: String },
    },

    data: () => ({
        imageErrored: false,
    }),
};
</script>
