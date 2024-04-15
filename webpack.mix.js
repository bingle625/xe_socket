const mix = require('laravel-mix');

mix.setPublicPath('dist')
    .js('resources/js/app.js', 'dist/js')
    .webpackConfig({
        resolve: {
            fallback: {
                "http": require.resolve("stream-http"),
                "https": require.resolve("https-browserify")
            }
        }
    });