<?php

namespace App\Constants;

class CategoryConstant
{
    public const MSG_NOT_FOUND = 'Không tìm thấy danh mục';
    public const MSG_CREATE_SUCCESS = 'Thêm danh mục thành công';
    public const MSG_UPDATE_SUCCESS = 'Cập nhật danh mục thành công';
    public const MSG_DELETE_SUCCESS = 'Xóa thành danh mục công';

    public const MSG = [
        'not_found' => self::MSG_NOT_FOUND,
        'create_success' => self::MSG_CREATE_SUCCESS,
        'update_success' => self::MSG_UPDATE_SUCCESS,
        'delete_success' => self::MSG_DELETE_SUCCESS,
    ];

}