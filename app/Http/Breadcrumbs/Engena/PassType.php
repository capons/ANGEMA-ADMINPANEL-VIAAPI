<?php

Breadcrumbs::register('admin.pass_types.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push(trans('menus.engena.passTypes.main'), route('admin.pass_types.index'));
});

Breadcrumbs::register('admin.pass_types.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.pass_types.index');
    $breadcrumbs->push(trans('menus.engena.passTypes.create'), route('admin.pass_types.create'));
});

Breadcrumbs::register('admin.pass_types.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.pass_types.index');
    $breadcrumbs->push(trans('menus.engena.passTypes.edit'), route('admin.pass_types.edit', $id));
});
