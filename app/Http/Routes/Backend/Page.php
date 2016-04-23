<?php

Route::group([
	'middleware' => 'access.routeNeedsPermission:view-pages-management',
], function () {
	Route::resource('pages', 'PageController');
});