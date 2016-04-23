<?php

Route::group([
	'prefix' => 'blog',
	'namespace' => 'Blog',
	'middleware' => 'access.routeNeedsPermission:view-blog-management',
], function () {
	Route::resource('categories', 'CategoryController');
	Route::resource('posts', 'PostController');
});