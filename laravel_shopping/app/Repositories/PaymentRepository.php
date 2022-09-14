<?php

namespace App\Repositories;

use App\Notification;
use App\NotificationUser;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\User;

class PaymentRepository extends BaseRepository
{
    const READ_NOT = '0';
    const TYPE_NOTIFICATION = '1';
    protected $userRepository;

    public function getModel()
    {
        return Order::class;
    }

    public function vnpay_payment($req, $vnp_Url)
    {
        $vnp_TxnRef = Str::random(10);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = route('cart-complete', ['vnp_TxnRef' => $vnp_TxnRef], ['req'=>$req]);
        $vnp_TmnCode = "DJH98NHO";
        $vnp_HashSecret = "SEILLOUJEROENYMJNHMBINIQXRMCLXFR";

        $vnp_OrderInfo = "Thanh toan";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = ($req->totalCart) * 100000;
        $vnp_Locale = "VND";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

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
            // "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (auth()->guard('api')->user()) {
            // header('Location: ' . $vnp_Url);
            // die();
            // return redirect()->to($vnp_Url)->send();
        } else {
            echo json_encode($returnData);
        }
    }

    public function cartComplete($req)
    {
        $cart = $req->cart;
        $totalCart = $req->totalCart;
        $countCart = $req->countCart;
        $idUser = $req->idUser;
        
        $user = User::where('id',$idUser)->first();

        $result = new Order();
        $result->user_id = $user->id;
        $result->total = $totalCart * 1000;
        $result->order_date = now()->format('Y-m-d H:i:s');
        $result->order_number = $req->vnp_TxnRef;
        $result->customer_address = $user->location;
        $result->customer_email = $user->email;
        $result->customer_name = $user->name;
        $result->customer_phone = $user->phone;
        $result->status = 'waiting';
        $result->save();

        $orderDetailArr = [];


        // foreach ($cart as $cartItem) {

        for ($i = 0; $i < $countCart; $i++) {
            $product = Product::where('id', $cart[$i]['product']['id'])->first();
            $order_detail = new OrderDetail();
            $order_detail->product_id = $product->id;
            $order_detail->order_id = $result->id;
            $order_detail->total = $cart[$i]['product']['price'] * $cart[$i]['quantily'];
            $order_detail->price = $cart[$i]['product']['price'];
            $order_detail->quantily = $cart[$i]['quantily'];
            // $orderDetailArr[] = $order_detail;
            $order_detail->save();
        }


        // }

        $notification = new Notification();
        $notification->title = 'order complete';
        $notification->content =  $result->order_number . '-' . $result->order_date;
        $notification->type = self::TYPE_NOTIFICATION;
        $notification->url = "Order";
        $notification->save();

        $user_notification = new NotificationUser();
        $user_notification->notification_id = $notification->id;
        $user_notification->user_id = $idUser;
        $user_notification->is_read = self::READ_NOT;
        $user_notification->save();

        // $result->order_details()->saveMany($orderDetailArr);

        return $user_notification;
    }

    public function create($req)
    {
        $category = new $this->model;

        $category->name = $req['name'];
        $category->slug = Str::slug($req['name']);
        $category->save();

        return $category->fresh();
    }

    public function update($id, $req)
    {
        $cate = $this->model->find($id);
        $cate->name = $req['name'];
        $cate->slug = Str::slug($req['name']);
        $cate->save();

        return $cate;
    }

    public function delete($id)
    {
        $cate = $this->model->find($id);
        $cate->delete();

        return $cate;
    }
}
