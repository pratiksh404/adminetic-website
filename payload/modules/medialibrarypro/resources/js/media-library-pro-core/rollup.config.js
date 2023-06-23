import resolve from '@rollup/plugin-node-resolve';
import babel from '@rollup/plugin-babel';
import typescript from '@rollup/plugin-typescript';
import commonjs from '@rollup/plugin-commonjs';
import json from '@rollup/plugin-json';

export default {
    input: './src/index.ts',
    output: {
        file: 'dist/index.js',
        format: 'es',
    },
    external: [/@babel\/runtime/],
    plugins: [
        resolve({ browser: true }),
        commonjs(),
        babel({ babelHelpers: 'runtime', configFile: '../../../babel.config.js' }),
        typescript(),
        json(),
    ],
};
