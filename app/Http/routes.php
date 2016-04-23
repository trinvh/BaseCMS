<?php

Route::get('images/{width}/{height}/{filename}', 'ImageController@getResize')
	->where(['width' => '[0-9]+', 'height' => '[0-9]+', 'filename' => '(.+)']);

Route::group(['middleware' => 'web'], function () {
	Route::group(['namespace' => 'Language'], function () {
		require (__DIR__ . '/Routes/Language/Language.php');
	});

	/** Frontend Routes */
	Route::group(['namespace' => 'Frontend'], function () {
		require (__DIR__ . '/Routes/Frontend/Frontend.php');
		require (__DIR__ . '/Routes/Frontend/Access.php');
	});
});

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
	require (__DIR__ . '/Routes/Backend/Dashboard.php');
	require (__DIR__ . '/Routes/Backend/Access.php');
	require (__DIR__ . '/Routes/Backend/LogViewer.php');
	require (__DIR__ . '/Routes/Backend/FileManager.php');
	require (__DIR__ . '/Routes/Backend/Navbar.php');
	require (__DIR__ . '/Routes/Backend/Page.php');
	require (__DIR__ . '/Routes/Backend/Setting.php');
	require (__DIR__ . '/Routes/Backend/Blog.php');
});
