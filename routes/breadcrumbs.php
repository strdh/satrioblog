<?php
 use App\Models\Post;
 use Diglactic\Breadcrumbs\Breadcrumbs;
 use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

 Breadcrumbs::for('management.index', function (BreadcrumbTrail $trail): void {
     $trail->push('Management');
 });