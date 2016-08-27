<?php

Breadcrumbs::register('admin.reserves.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.engena.reserves.main'), route('admin.reserves.index'));
});

Breadcrumbs::register('admin.reserves.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.reserves.index');
    $breadcrumbs->push(trans('menus.engena.reserves.create'), route('admin.reserves.create'));
});

Breadcrumbs::register('admin.reserves.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.reserves.index');
    $breadcrumbs->push(trans('menus.engena.reserves.edit'), route('admin.reserves.edit', $id));
});
