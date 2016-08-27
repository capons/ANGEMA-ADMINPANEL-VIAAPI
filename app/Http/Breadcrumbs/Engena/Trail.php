<?php

Breadcrumbs::register('admin.trails.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.engena.trails.main'), route('admin.trails.index'));
});

Breadcrumbs::register('admin.trails.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.trails.index');
    $breadcrumbs->push(trans('menus.engena.trails.create'), route('admin.trails.create'));
});

Breadcrumbs::register('admin.trails.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.trails.index');
    $breadcrumbs->push(trans('menus.engena.trails.edit'), route('admin.trails.edit', $id));
});
