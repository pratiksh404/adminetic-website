<template>
    <span :class="`media-library-button media-library-button-${level}`">
        <icon :icon="icon" />
    </span>
</template>

<script>
import Icon from './Icon.vue';

export default {
    props: {
        icon: { required: true, type: String },
        level: { default: 'info', type: String },
    },

    components: { Icon },
};
</script>
