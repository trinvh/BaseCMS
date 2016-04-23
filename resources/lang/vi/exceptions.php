<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Exception Language Lines
		    |--------------------------------------------------------------------------
		    |
		    | The following language lines are used in Exceptions thrown throughout the system.
		    | Regardless where it is placed, a button can be listed here so it is easily
		    | found in a intuitive way.
		    |
	*/

	'backend' => [
		'access' => [
			'permissions' => [
				'create_error' => 'Không thể tạo quyền này. Vui lòng thử lại.',
				'delete_error' => 'Không thể xóa quyền này. Vui lòng thử lại.',

				'groups' => [
					'associated_permissions' => 'Bạn không thể xóa nhóm vì nó liên quan đến những quyền khác.',
					'has_children' => 'Không thể xóa nhóm này vì nó có nhóm con.',
					'name_taken' => 'Quyền (tên) này đã được tạo trước đó',
				],

				'not_found' => 'Quyền không tồn tại.',
				'system_delete_error' => 'Bạn không thể xóa quyền hệ thống.',
				'update_error' => 'Không thể cập nhật quyền. Vui lòng thử lại.',
			],

			'roles' => [
				'already_exists' => 'Vai trò đã tồn tại.',
				'cant_delete_admin' => 'Bạn không thể xóa vai trò hệ thống.',
				'create_error' => 'Không thể tạo vai trò mới.',
				'delete_error' => 'Không thể xóa vai trò này.',
				'has_users' => 'Vai trò này liên quan đến một hoặc nhiều thành viên. Cập nhật lại thành viên trước khi xóa.',
				'needs_permission' => 'Bạn phải chọn ít nhất 1 quyền cho vai trò này.',
				'not_found' => 'Không tồn tại.',
				'update_error' => 'Không thể cập nhật vai trò này.',
			],

			'users' => [
				'cant_deactivate_self' => 'Bạn không thể vô hiệu chính mình.',
				'cant_delete_self' => 'Bạn không thể xóa chính bạn.',
				'create_error' => 'Không thể tạo thành viên, thử lại sau.',
				'delete_error' => 'Không thể xóa thành viên, thử lại sau.',
				'email_error' => 'Email này đã có người dùng.',
				'mark_error' => 'Không thể cập nhật thành viên này.',
				'not_found' => 'Không tồn tại.',
				'restore_error' => 'Không thể phục hồi thành viên này, thử lại sau.',
				'role_needed_create' => 'Bạn phải chọn ít nhất 1 vai trò, thành viên đã tạo nhưng chưa kích hoạt.',
				'role_needed' => 'Bạn phải chọn ít nhất 1 vai trò.',
				'update_error' => 'Không thể cập nhật thành viên, thử lại sau.',
				'update_password_error' => 'Không thể cập nhật mật khẩu thành viên này, thử lại sau.',
			],
		],
	],

	'frontend' => [
		'auth' => [
			'confirmation' => [
				'already_confirmed' => 'Tài khoản của bạn đã được kích hoạt.',
				'confirm' => 'Kích hoạt tài khoản của bạn!',
				'created_confirm' => 'Tài khoản đã được tạo thành công. Chúng tôi đã gửi 1 email cho bạn để xác nhận.',
				'mismatch' => 'Mã xác nhận không đúng.',
				'not_found' => 'Mã xác nhận không tồn tại.',
				'resend' => 'Tài khoản của bạn chưa được xác nhận, vui lòng click vào link mà chúng tôi đã gửi trong email đến địa chỉ của bạn, hoặc <a href="' . route('account.confirm.resend', ':user_id') . '">nhấn vào đây</a> để gửi lại email xác nhận.',
				'success' => 'Tài khoản của bạn đã được xác nhận thành công!',
				'resent' => 'Thư xác nhận mới đã được gửi đến địa chỉ email của bạn.',
			],

			'deactivated' => 'Tài khoản của bạn đã bị vô hiệu hóa.',
			'email_taken' => 'Địa chỉ email đã được sử dụng.',

			'password' => [
				'change_mismatch' => 'Đó không phải mật khẩu cũ của bạn.',
			],

		],
	],
];