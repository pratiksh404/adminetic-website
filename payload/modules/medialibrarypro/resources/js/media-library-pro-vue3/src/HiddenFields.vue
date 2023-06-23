<template>
    <div style="display: none">
        <template v-for="object in mediaState">
            <template v-for="parameterName in getObjPaths(object.attributes)">
                <input
                    :name="`${name}[${object.attributes.uuid}]${parameterName}`"
                    :value="sanitizeForInput(get(object.attributes, parameterName))"
                    type="hidden"
                />
            </template>
        </template>
    </div>
</template>

<script>
import { sanitizeForInput, getObjPaths } from '@spatie/media-library-pro-core';
import get from 'lodash/get';

export default {
    props: {
        name: { required: true, type: String },
        mediaState: { default: () => [], type: Array },
    },

    methods: {
        getObjPaths,
        sanitizeForInput,
        get,
    },
};
</script>
