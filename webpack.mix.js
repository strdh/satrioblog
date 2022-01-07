const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.styles([
    'resources/css/frontpage/frontpage.css',
    'resources/css/ckeditor.css',
], 'public/css/frontpage.css').version()

mix.styles([
    // 'resources/css/management/datatables.min.css',
    'resources/css/management/management.css',
    'resources/css/ckeditor.css',
], 'public/css/management.css').version()
//mangement lib
// mix.scripts([
//     'resources/js/management/bootstrap.js',
//     'resources/js/management/datatables.min.js',
//     'resources/js/management/popper.js',
//     'resources/js/management/management.js',
// ], 'public/js/lib-managenent.js').version();
//management
mix.scripts([
    'resources/js/management/slider.js',
    'resources/js/management/contact.js',
    'resources/js/management/about.js',
    'resources/js/management/post.js',
    'resources/js/management/category.js',
    'resources/js/ckeditor.js',
    'resources/js/management/textbox.js',
], 'public/js/app-management.js').version();
//frontpage lib
// mix.scripts([
//     'resources/js/management/slider.js',
// ], 'public/js/lib-frontpage.js').version();
//frontpage
mix.scripts([
    'resources/js/ckeditor.js',
], 'public/js/app-frontpage.js').version();