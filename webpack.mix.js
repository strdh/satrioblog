const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.styles([
    'resources/css/ckeditor.css',
], 'public/css/manage.css').version()

mix.scripts([
    'resources/js/management/slider.js',
    'resources/js/management/contact.js',
    'resources/js/management/about.js',
    'resources/js/management/post.js',
    'resources/js/management/category.js',
    'resources/js/management/ckeditor.js',
    'resources/js/management/textbox.js',
], 'public/js/app-management.js').version();
