import resolve from '@rollup/plugin-node-resolve'
import babel from '@rollup/plugin-babel'
import { terser } from 'rollup-plugin-terser'

export default {
    input: 'scripts/index.js',
    output: {
        file: 'js/index.js',
        format: 'iife',
        plugins: [terser()]
    },
    plugins: [
        resolve(),
        babel({ babelHelpers: 'bundled' })
    ],
    watch: {
        buildDelay: 10
    }
}