<template>
    <svg class="media-library-icon">
        <use :xlink:href="'#icon-' + icon"></use>
    </svg>
</template>

<script>
export default {
    props: {
        icon: { required: true, type: String },
    },
};
</script>
