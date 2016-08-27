<?php

Breadcrumbs::register('admin.regions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.engena.regions.main'), route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.regions.index');
    $breadcrumbs->push(trans('menus.engena.regions.create'), route('admin.regions.create'));
});

Breadcrumbs::register('admin.regions.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.regions.index');
    $breadcrumbs->push(trans('menus.engena.regions.edit'), route('admin.regions.edit', $id));
});
