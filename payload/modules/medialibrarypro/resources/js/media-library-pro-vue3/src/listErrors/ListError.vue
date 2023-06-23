<template>
    <li class="media-library-listerror">
        <div class="media-library-listerror-icon">
            <span class="media-library-button media-library-button-error">
                <icon icon="error" />
            </span>
        </div>
        <div class="media-library-listerror-content">
            <div class="media-library-listerror-title">
                <span>{{ title }}</span>
            </div>

            <ul v-if="$slots.default" class="media-library-listerror-items">
                <slot />
            </ul>
        </div>
    </li>
</template>

<script>
import Icon from '../components/Icon.vue';

export default {
    props: {
        title: { required: true, type: String },
    },

    components: { Icon },
};
</script>
