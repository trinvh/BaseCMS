<?php
Route::group([
	'middleware' => 'access.routeNeedsPermission:view-files-management',
], function () {
	Route::resource('filemanager', 'FileController');
	Route::controller('filemanager', 'FileController',
		['postFolder' => 'admin.filemanager.folder']
	);
});