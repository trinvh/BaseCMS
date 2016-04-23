<?php

Route::group([
	'middleware' => 'access.routeNeedsPermission:view-navbars-management',
], function () {
	Route::resource('navbars', 'NavbarController');
	Route::post('navbars/orders', 'NavbarController@orders')->name('admin.navbars.orders');
});