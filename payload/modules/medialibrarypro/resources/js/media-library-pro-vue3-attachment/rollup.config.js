import resolve from '@rollup/plugin-node-resolve';
import babel from '@rollup/plugin-babel';
import vue from 'rollup-plugin-vue';
import commonjs from '@rollup/plugin-commonjs';
import json from '@rollup/plugin-json';

export default {
    input: './src/index.js',
    output: {
        file: 'dist/index.js',
        format: 'es',
        globals: { vue: 'Vue' },
    },
    external: ['vue' /* /@babel\/runtime/ */],
    plugins: [
        resolve({ browser: true }),
        commonjs({ include: /node_modules/ }),
        vue(),
        babel({ babelHelpers: 'runtime', configFile: '../../../babel.config.js' }),
        json(),
    ],
};
