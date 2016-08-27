<?php

Breadcrumbs::register('admin.pass_durations.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push(trans('menus.engena.passDurations.main'), route('admin.pass_durations.index'));
});

Breadcrumbs::register('admin.reserve.durations.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.pass_durations.index');
    $breadcrumbs->push(trans('menus.engena.passDurations.create'), route('admin.pass_durations.create'));
});

Breadcrumbs::register('admin.reserve.durations.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.pass_durations.index');
    $breadcrumbs->push(trans('menus.engena.passDurations.edit'), route('admin.pass_durations.edit', $id));
});
