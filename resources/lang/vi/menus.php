<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Menus Language Lines
		    |--------------------------------------------------------------------------
		    |
		    | The following language lines are used in menu items throughout the system.
		    | Regardless where it is placed, a menu item can be listed here so it is easily
		    | found in a intuitive way.
		    |
	*/

	'backend' => [
		'access' => [
			'title' => 'Quản lý truy cập',

			'permissions' => [
				'all' => 'Tất cả quyền hạn',
				'create' => 'Tạo quyền',
				'edit' => 'Sửa quyền',
				'groups' => [
					'all' => 'Tất cả nhóm',
					'create' => 'Tạo nhóm',
					'edit' => 'Sửa nhóm',
					'main' => 'Nhóm quyền',
				],
				'main' => 'Quyền hạn',
				'management' => 'Quản lý quyền hạn',
			],

			'roles' => [
				'all' => 'Tất cả vai trò',
				'create' => 'Tạo vai trò',
				'edit' => 'Sửa vai trò',
				'management' => 'Quản lý vai trò',
				'main' => 'Vai trò',
			],

			'users' => [
				'all' => 'Tất cả người dùng',
				'change-password' => 'Đổi mật khẩu',
				'create' => 'Tạo thành viên',
				'deactivated' => 'Thành viên đã vô hiệu',
				'deleted' => 'Thành viên đã xóa',
				'edit' => 'Sửa thành viên',
				'main' => 'Thành viên',
			],
		],

		'log-viewer' => [
			'main' => 'Quản lý logs',
			'dashboard' => 'Dashboard',
			'logs' => 'Logs',
		],

		'sidebar' => [
			'dashboard' => 'Dashboard',
			'general' => 'General',
		],
	],

	'language-picker' => [
		'language' => 'Ngôn ngữ',
		/**
		 * Add the new language to this array.
		 * The key should have the same language code as the folder name.
		 * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
		 * Be sure to add the new language in alphabetical order.
		 */
		'langs' => [
			'da' => 'Danish',
			'de' => 'German',
			'en' => 'English',
			'es' => 'Spanish',
			'fr' => 'French',
			'it' => 'Italian',
			'pt-BR' => 'Brazilian Portuguese',
			'sv' => 'Swedish',
			'vi' => 'Tiếng Việt',
		],
	],
];
