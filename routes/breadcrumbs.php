<?php
 use App\Models\Post;
 use Diglactic\Breadcrumbs\Breadcrumbs;
 use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('management.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Management', route('management.index'));
});
//post
Breadcrumbs::for('management.post.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.index');
    $trail->push('Post', route('management.post.index'));
});

Breadcrumbs::for('management.post.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.post.index');
    $trail->push('Create', route('management.post.create'));
});

Breadcrumbs::for('management.post.edit', function (BreadcrumbTrail $trail, $post): void {
    $trail->parent('management.post.index');
    $trail->push('Edit', route('management.post.edit', $post));
});
//category
Breadcrumbs::for('management.category.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.index');
    $trail->push('Category', route('management.category.index'));
});

Breadcrumbs::for('management.category.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.category.index');
    $trail->push('Create', route('management.category.create'));
});

Breadcrumbs::for('management.category.edit', function (BreadcrumbTrail $trail, $post): void {
    $trail->parent('management.category.index');
    $trail->push('Edit', route('management.category.edit', $post));
});
//about
Breadcrumbs::for('management.about.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.index');
    $trail->push('About', route('management.about.index'));
});

Breadcrumbs::for('management.about.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.about.index');
    $trail->push('Create', route('management.about.create'));
});

Breadcrumbs::for('management.about.edit', function (BreadcrumbTrail $trail, $post): void {
    $trail->parent('management.about.index');
    $trail->push('Edit', route('management.about.edit', $post));
});
//contact
Breadcrumbs::for('management.contact.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.index');
    $trail->push('Contact', route('management.contact.index'));
});

Breadcrumbs::for('management.contact.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.contact.index');
    $trail->push('Create', route('management.contact.create'));
});

Breadcrumbs::for('management.contact.edit', function (BreadcrumbTrail $trail, $post): void {
    $trail->parent('management.contact.index');
    $trail->push('Edit', route('management.contact.edit', $post));
});
//slider
Breadcrumbs::for('management.slider.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.index');
    $trail->push('Slider', route('management.slider.index'));
});

Breadcrumbs::for('management.slider.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('management.slider.index');
    $trail->push('Create', route('management.slider.create'));
});

Breadcrumbs::for('management.slider.edit', function (BreadcrumbTrail $trail, $post): void {
    $trail->parent('management.slider.index');
    $trail->push('Edit', route('management.slider.edit', $post));
});