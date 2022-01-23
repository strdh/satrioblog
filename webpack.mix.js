const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

//================================CSS================================

mix.styles([
    'resources/css/frontpage/bootstrap.css',
    'resources/css/frontpage/frontpage.css',
    'resources/css/frontpage/ckeditor.css',
], 'public/css/frontpage.css').version()

mix.styles([
    'resources/css/management/management.css',
    'resources/DataTables/datatables.css',
    'resources/css/management/ckeditor.css',
], 'public/css/management.css').version()

mix.styles([
    'resources/css/writer/writer.css',
    'resources/DataTables/datatables.css',
    'resources/css/writer/ckeditor.css',
], 'public/css/writer.css').version()

//======================================JS========================================

//frontpage lib
mix.scripts([
    'resources/js/frontpage/bootstrap.js',
], 'public/js/lib-frontpage.js').version();

//frontpage
mix.scripts([
    'resources/js/ckeditor.js',
    'resources/js/frontpage/frontpage.js',
], 'public/js/app-frontpage.js').version();

//mangement lib
mix.scripts([
    'resources/js/fontawesome.js',
    'resources/js/jquery.js',
    'resources/js/management/bootstrap.js',
    'resources/DataTables/datatables.min.js',
    'resources/js/management/popper.js',
], 'public/js/lib-management.js').version();

//management
mix.scripts([
    'resources/js/management/management.js',
    'resources/js/management/slider.js',
    'resources/js/management/contact.js',
    'resources/js/management/about.js',
    'resources/js/management/post.js',
    'resources/js/management/category.js',
    'resources/js/management/message.js',
    'resources/js/management/mainmenu.js',
    'resources/js/ckeditor.js',
    'resources/js/management/textbox.js',
], 'public/js/app-management.js').version();

