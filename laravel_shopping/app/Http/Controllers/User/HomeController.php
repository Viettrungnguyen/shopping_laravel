<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Services\CartService;
use App\Services\CommentService;
use App\Services\NotificationService;
use App\Services\PaymentService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    protected $cartService;
    protected $paymentService;
    protected $commentService;
    protected $notificationService;

    public function __construct(CartService $cartService, PaymentService $paymentService, CommentService $commentService, NotificationService $notificationService)
    {
        $this->cartService = $cartService;
        $this->paymentService = $paymentService;
        $this->commentService = $commentService;
        $this->notificationService = $notificationService;
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();

        if ($request->user()) {
            $notifications = $this->notificationService->findNotificationUser();
            $data = [
                'categories' => $categories,
                'products' => $products,
                'notifications' => $notifications,
            ];
            return response()->json($data);
        }

        if (!$request->user()) {
            $data = [
                'categories' => $categories,
                'products' => $products,
            ];
            return response()->json($data);
        }
    }

    public function newProduct()
    {
        $newProducts = Product::orderByDesc('created_at')->get();

        return response()->json($newProducts);
    }

    public function singleProduct(Request $request, $slug)
    {
        $singleProduct = Product::where('slug', $slug)->first();

        $relatedProducts = Product::where('category_id', $singleProduct->category_id)->get();
        $category = Category::where('id', $singleProduct->category_id)->first();
        $newProducts = Product::orderByDesc('created_at')->get();
        $comments = $this->commentService->getAll();
        $users = User::all();
        $tag = [];
        foreach ($singleProduct->tags as $tags) {
            array_push($tag, $tags->name);
        }
        if ($request->user()) {
            $notifications = $this->notificationService->findNotificationUser();
            $data = [
                'singleProduct' => $singleProduct,
                'relatedProducts' => $relatedProducts,
                'newProducts' => $newProducts,
                'notifications' => $notifications,
                'comments' => $comments,
                'users' => $users,
                'category' => $category,
                'tags' => $tag,
            ];
            return response()->json($data);
        }
        if (!$request->user()) {
            $data = [
                'singleProduct' => $singleProduct,
                'relatedProducts' => $relatedProducts,
                'newProducts' => $newProducts,
                'comments' => $comments,
                'users' => $users,
                'category' => $category,
                'tags' => $tag,
            ];
            return response()->json($data);
        }
    }

    public function listComment()
    {
        $comments = $this->commentService->getAll();
    }

    public function createComment(Request $request)
    {
        $req = $request;
        $title = 'Comment complete';
        if (!Auth::user()) {
            return redirect()->back()->with('message', 'Đăng nhập để tiếp tục comment');
        }

        $this->commentService->create($req);
        $this->notificationService->create($req, $title);

        return redirect()->back();
    }

    public function vnpay_payment(Request $request)
    {
        $req = $request;

        if (!auth()->guard('api')->user()) {
            return response()->json([
                'message' => 'Vui lòng đăng nhập để thanh toán'
            ]);
        }

        if (auth()->guard('api')->user()) {
            if ($req->cart == []) {
                return response()->json([
                    'message' => 'Vui lòng thêm sản phẩm vào giỏ hàng để tiếp tục'
                ], 201);
            }
            if (auth()->guard('api')->user()->location == "" || auth()->guard('api')->user()->phone == "") {
                return response()->json([
                    'message' => 'Vui lòng nhập thông tin tai khoản để tiếp tục'
                ], 202);
            }
            if (auth()->guard('api')->user()->location != "" || auth()->guard('api')->user()->phone != "") {

                // $this->paymentService->vnpay_payment($req,$vnp_Url);
                $idUser = auth()->guard('api')->user()->id;
                $vnp_TxnRef = Str::random(10);

                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://localhost:3000/web/call_back?idUser=" . $idUser;

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
                    "vnp_ReturnUrl" => $vnp_Returnurl,
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
        }
        return response()->json([
            'url' => $vnp_Url
        ], 203);
    }

    public function cartComplete(Request $req)
    {
        if (Order::where('order_number', $req->vnp_TxnRef)->first() || $req->vnp_TxnRef == 'undefined') {
            return response()->json([
                'message' => 'Order '
            ], 201);
        }

        $category['data'] = $this->paymentService->cartComplete($req);

        return response()->json([
            'message' => 'Order thành công'
        ], 200);
    }

    public function myOrder()
    {
        $myOder = Order::where('user_id', auth()->guard('api')->user()->id)->get();

        return response()->json($myOder);
    }
}
