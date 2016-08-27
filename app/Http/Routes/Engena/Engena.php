<?php

Route::resource('passes', 'PassController', ['except' => ['show']]);
Route::resource('pass_types', 'PassTypeController', ['except' => ['show']]);
Route::resource('pass_durations', 'PassDurationController', ['except' => ['show']]);

Route::resource('regions', 'RegionController', ['except' => ['show']]);
Route::resource('reserves', 'ReserveController', ['except' => ['show']]);
Route::resource('trails', 'TrailController', ['except' => ['show']]);
