var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/app', [
        './assets/js/app.js',
        "./assets/js/contact_me.js",
        "./assets/js/jqBootstrapValidation.js",
        "./assets/js/invoice_list.js"
    ])
    .addStyleEntry('css/app', [
        './assets/scss/app.scss',
        './assets/css/modern-business.css'
    ])
    .addStyleEntry('css/signin', [
        './assets/css/signin.css'
    ])
    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/image', to: 'image' }
    ]))
    // uncomment if you use Sass/SCSS files
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    })

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
