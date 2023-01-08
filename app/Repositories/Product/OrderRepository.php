<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\OrderRepositoryInterface;
use App\Models\OrderItem;
use Carbon;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Order::class;
    }

    public function getOrderByUserId($userId)
    {
        $orders = $this->model
        ->where('user_id', $userId)
        ->orderBy('created_at', 'DESC')
        ->get();

        return $orders;
    }

    public function getOrderByStatus($userId, $status)
    {
        if ($status !== null && $userId !== null) {
            $orders = $this->model
            ->where('user_id', $userId)
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->get();
        } elseif ($status !== null && $userId == null) {
            $orders = $this->model
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->get();
        }

        return $orders;
    }

    public function getOrderStatus()
    {
        $arrStatus = [];
        $orders = $this->model->all();
        foreach ($orders as $order) {
            $arrStatus[] = $order->status;
        }

        return array_unique($arrStatus);
    }

    public function getOrderCancel($userId)
    {
        $orderCancels = $this->model
            ->where('user_id', $userId)
            ->where('status', 'cancel')
            ->get();

        return $orderCancels;
    }

    public function getBoughtTotalPrice($userId)
    {
        $orderCompletes = $this->model
            ->where('user_id', $userId)
            ->where('status', 'complete')
            ->get();

        $boughtTotal = 0;
        foreach ($orderCompletes as $orderComplete) {
            $orderItems = OrderItem::where('order_id', $orderComplete->id)->get();
            foreach ($orderItems as $orderItem) {
                $boughtTotal += $orderItem->total_price;
            }
        }

        return $boughtTotal;
    }

    public function getOrderPagination()
    {
        $orders = $this->model
            ->orderBy('updated_at', 'DESC')
            ->paginate(7, ['*'], 'np');

        return $orders;
    }

    public function checkOutVNpay($request, $orderId)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/checkoutSuccess";
        $vnp_TmnCode = "JUKCRV0F";//Mã website tại VNPAY
        $vnp_HashSecret = "FLCMFRNRQSVHLBZCILUNQBCQOCUSPSXI"; //Chuỗi bí mật

        $vnp_TxnRef = $orderId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toan don hang test';
        $vnp_OrderType = 'payment_method';
        $vnp_Amount = $request->sumTotalPrice * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //Billing

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );

        // if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
        // } else {
        //     echo json_encode($returnData);
        // }
    }
}
