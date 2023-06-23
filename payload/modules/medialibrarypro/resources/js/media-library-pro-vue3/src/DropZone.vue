<template>
    <div v-bind="$attrs" @drop="handleDrop" @click.stop="$emit('clicked')">
        <slot v-bind="$data"></slot>
    </div>
</template>

<script>
import { getFileTypeIsAllowed } from '@spatie/media-library-pro-core';

export default {
    props: {
        validationAccept: { default: () => [], type: Array },
    },

    emits: ['clicked', 'dropped'],

    data: () => ({
        hasDragObject: false,
        isDropTarget: false,
        isValid: true,
    }),

    mounted() {
        document.addEventListener('dragenter', this.handleDocumentDragenter);
        document.addEventListener('dragleave', this.handleDocumentDragleave);
        document.addEventListener('dragover', this.handleDocumentDragOver);
        document.addEventListener('drop', this.handleDocumentDrop);
    },

    beforeUnmount() {
        document.removeEventListener('dragenter', this.handleDocumentDragenter);
        document.removeEventListener('dragleave', this.handleDocumentDragleave);
        document.removeEventListener('dragover', this.handleDocumentDragOver);
        document.removeEventListener('drop', this.handleDocumentDrop);
    },

    methods: {
        handleDocumentDragenter(e) {
            e.preventDefault();

            if (e.dataTransfer.dropEffect === 'move') {
                return;
            }

            this.testIfValid(e);

            this.hasDragObject = true;
        },

        handleDocumentDragleave(e) {
            if (!e.clientX && !e.clientY) {
                e.preventDefault();

                this.hasDragObject = false;
            }
        },

        handleDocumentDrop(e) {
            e.preventDefault();

            this.hasDragObject = false;
        },

        handleDocumentDragOver(e) {
            e.preventDefault();

            const overElement = this.$el.contains(e.target);

            if (!overElement) {
                return (this.isDropTarget = false);
            }

            this.isDropTarget = true;
        },

        handleDrop(e) {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                this.$emit('dropped', e);
            }

            this.hasDragObject = false;
            this.isDropTarget = false;
        },

        testIfValid(e) {
            if (!e.dataTransfer.items || !e.dataTransfer.items.length) {
                return (this.isValid = true);
            }

            if (!this.validationAccept || !this.validationAccept.length) {
                return (this.isValid = true);
            }

            this.isValid = Array.from(e.dataTransfer.items).every((item) => {
                return getFileTypeIsAllowed(item.type, this.validationAccept);
            });
        },
    },
};
</script>
