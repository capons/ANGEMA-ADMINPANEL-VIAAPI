<?php

Route::get('', 'DashboardController@index')->name('admin.index');
Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
