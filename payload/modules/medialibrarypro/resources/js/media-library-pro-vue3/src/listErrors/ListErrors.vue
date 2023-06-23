<template>
    <div v-if="invalidMedia.length || (topLevelErrors.length && !hideTopLevelErrors)" class="media-library-listerrors">
        <ul>
            <template v-if="!hideTopLevelErrors">
                <list-error v-for="error in topLevelErrors" :title="error" />
            </template>

            <list-error v-for="[error, invalidObjects] in Object.entries(groupedInvalidMedia)" :title="error">
                <li v-for="object in invalidObjects" class="media-library-listerror-item">
                    <div class="media-library-listerror-thumb">
                        <object-preview :client_preview="object.client_preview || ''" :name="object.attributes.name" />
                    </div>
                    <div class="media-library-listerror-text">{{ object.attributes.name }}</div>
                </li>
            </list-error>
        </ul>

        <div class="media-library-row-remove media-library-text-error" @click.stop="onClearClick">
            <icon icon="remove"></icon>
        </div>
    </div>
</template>

<script>
import Icon from '../components/Icon.vue';
import ListError from './ListError.vue';
import ObjectPreview from './ObjectPreview.vue';

export default {
    props: {
        invalidMedia: { default: () => ({}), type: Array },
        topLevelErrors: { default: () => [], type: Array },
    },

    emits: ['cleared'],

    components: { Icon, ListError, ObjectPreview },

    data: () => ({
        erroredImages: [],
        hideTopLevelErrors: false,
    }),

    watch: {
        topLevelErrors: {
            deep: true,
            immediate: true,
            handler: function (val) {
                if (val) {
                    this.hideTopLevelErrors = false;
                }
            },
        },
    },

    computed: {
        groupedInvalidMedia() {
            return this.invalidMedia.reduce((groupedInvalidMedia, invalidMediaObject) => {
                const error = invalidMediaObject.errors[0];

                if (groupedInvalidMedia[error]) {
                    groupedInvalidMedia[error].push(invalidMediaObject);
                } else {
                    groupedInvalidMedia[error] = [invalidMediaObject];
                }

                return groupedInvalidMedia;
            }, {});
        },
    },

    methods: {
        onClearClick() {
            this.hideTopLevelErrors = true;
            this.$emit('cleared');
        },
    },
};
</script>
