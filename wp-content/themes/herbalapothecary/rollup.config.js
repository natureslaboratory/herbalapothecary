import resolve from '@rollup/plugin-node-resolve'
import babel from '@rollup/plugin-babel'
import { terser } from 'rollup-plugin-terser'
import typescript from '@rollup/plugin-typescript'

export default {
    input: 'scripts/index.ts',
    output: {
        file: 'js/index.js',
        format: 'iife',
        plugins: [terser()]
    },
    plugins: [
        resolve(),
        babel({ babelHelpers: 'bundled' }),
        typescript()
    ],
    watch: {
        buildDelay: 10
    }
}