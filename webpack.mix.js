const MonacoWebpackPlugin = require('monaco-editor-webpack-plugin');
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .setPublicPath('public_html')
    .js('resources/js/app.js', 'public_html/js')
    .postCss('resources/css/app.css', 'public_html/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig({
        plugins: [
            new MonacoWebpackPlugin({
                languages: ['css', 'html', 'javascript', 'json', 'scss', 'typescript'],
            }),
        ],
    })
    .browserSync("127.0.0.1:8000");

if (mix.inProduction()) {
    mix.version();
}
