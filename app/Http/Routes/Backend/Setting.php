<?php

Route::group([
	'middleware' => 'access.routeNeedsPermission:view-settings',
], function () {
	Route::resource('settings', 'SettingController');
});