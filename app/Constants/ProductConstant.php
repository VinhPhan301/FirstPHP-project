<?php

namespace App\Constants;

class ProductConstant
{
    public const MSG_NOT_FOUND = 'Không tìm thấy sản phẩm';
    public const MSG_CREATE_SUCCESS = 'Thêm sản phẩm thành công';
    public const MSG_UPDATE_SUCCESS = 'Cập nhật sản phẩm thành công';
    public const MSG_DELETE_SUCCESS = 'Xóa sản phẩm thành công';

    public const MSG = [
        'not_found' => self::MSG_NOT_FOUND,
        'create_success' => self::MSG_CREATE_SUCCESS,
        'update_success' => self::MSG_UPDATE_SUCCESS,
        'delete_success' => self::MSG_DELETE_SUCCESS,
    ];
}