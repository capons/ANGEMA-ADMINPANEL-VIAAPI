<?php

Breadcrumbs::register('admin.passes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push(trans('menus.engena.passes.main'), route('admin.passes.index'));
});

Breadcrumbs::register('admin.passes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.passes.index');
    $breadcrumbs->push(trans('menus.engena.passes.create'), route('admin.passes.create'));
});

Breadcrumbs::register('admin.passes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.passes.index');
    $breadcrumbs->push(trans('menus.engena.passes.edit'), route('admin.passes.edit', $id));
});
