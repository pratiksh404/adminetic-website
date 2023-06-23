import babel from '@rollup/plugin-babel';
import vue from 'rollup-plugin-vue';
import commonjs from '@rollup/plugin-commonjs';
import typescript from '@rollup/plugin-typescript';
import json from '@rollup/plugin-json';

export default {
    input: './src/index.js',
    output: {
        file: 'dist/index.js',
        format: 'es',
        globals: { vue: 'Vue', Vue: 'Vue' },
    },
    external: ['vue', 'Vue' /* /@babel\/runtime/ */],
    plugins: [
        /* resolve({ extensions: ['.js', '.json', '.vue', 'ts'] }), */
        commonjs({ include: /node_modules/ }),
        vue(),
        typescript(),
        babel({ babelHelpers: 'runtime', configFile: '../../../babel.config.js' }),
        json(),
    ],
};
