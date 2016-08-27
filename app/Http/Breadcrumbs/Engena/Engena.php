<?php

Breadcrumbs::register('admin.index', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('admin.index'));
});

require __DIR__ . '/Pass.php';
require __DIR__ . '/PassDuration.php';
require __DIR__ . '/PassType.php';
require __DIR__ . '/Region.php';
require __DIR__ . '/Reserve.php';
require __DIR__ . '/Trail.php';
