<?php

namespace App\Constants;

class UserConstant
{
    public const MSG_NOT_FOUND = 'Không tìm thấy tài khoản';
    public const MSG_CREATE_SUCCESS = 'Thêm tài khoản thành công';
    public const MSG_UPDATE_SUCCESS = 'Cập nhật tài khoản thành công';
    public const MSG_DELETE_SUCCESS = 'Thay đổi trạng thái thành công';
    public const MSG_LOGIN_FAIL = 'Password không chính xác';
    public const MSG_LOGIN_SUCCESS = 'Đăng nhập thành công';
    public const MSG_LOGOUT_SUCCESS = 'Bạn đã đăng xuất';

    public const MSG = [
        'not_found' => self::MSG_NOT_FOUND,
        'create_success' => self::MSG_CREATE_SUCCESS,
        'update_success' => self::MSG_UPDATE_SUCCESS,
        'delete_success' => self::MSG_DELETE_SUCCESS,
        'login_fail' => self::MSG_LOGIN_FAIL,
        'logout_success' => self::MSG_LOGOUT_SUCCESS,
        'login_success' => self::MSG_LOGIN_SUCCESS
    ];

    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_EMAIL = 'email';
    public const COLUMN_PASSWORD = 'password';
    public const COLUMN_ADDRESS = 'address';
    public const COLUMN_PHONE = 'phone';
    public const COLUMN_DOB = 'date_of_birth';
    public const COLUMN_ROLE = 'role';

    public const COLUMN = [
        'id' => self::COLUMN_ID,
        'name' => self::COLUMN_NAME,
        'email' => self::COLUMN_EMAIL,
        'password' => self::COLUMN_PASSWORD,
        'address' => self::COLUMN_ADDRESS,
        'phone' => self::COLUMN_PHONE,
        'date_of_birth' => self::COLUMN_DOB,
        'role' => self::COLUMN_ROLE,
    ];
}
