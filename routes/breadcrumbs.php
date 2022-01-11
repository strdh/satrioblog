<?php

 use Diglactic\Breadcrumbs\Breadcrumbs;
 use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('management.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Management', route('management.index'));
});

Breadcrumbs::for('parent', function (BreadcrumbTrail $trail, $name, $route): void {
    $trail->parent('management.index');
    $trail->push($name, route($route));
});

Breadcrumbs::for('create', function (BreadcrumbTrail $trail, $pName, $pRoute, $route): void {
    $trail->parent('parent', $pName, $pRoute);
    $trail->push('Create', route($route));
});

Breadcrumbs::for('edit', function (BreadcrumbTrail $trail, $pName, $pRoute, $route, $post): void {
    $trail->parent('parent', $pName, $pRoute);
    $trail->push('Edit', route($route, $post));
});

Breadcrumbs::for('editpassword', function (BreadcrumbTrail $trail, $pName, $pRoute, $route): void {
    $trail->parent('parent', $pName, $pRoute);
    $trail->push('EditPassword', route($route));
});