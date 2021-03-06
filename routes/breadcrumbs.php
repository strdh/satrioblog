<?php

 use Diglactic\Breadcrumbs\Breadcrumbs;
 use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

 //Management
Breadcrumbs::for('management.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('management.index'));
});

//Writer
Breadcrumbs::for('writer.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard Writer', route('writer.index'));
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

