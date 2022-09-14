<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Notification;
use App\NotificationUser;
use App\Role;
use Illuminate\Support\Str;
use App\Services\LoginService;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    const LOGIN_SUCCESS = "Đăng nhập thành công";
    const LOGIN_FAIL = "Tài khoản hoặc mật khẩu không chính xác";
    protected $service;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'fails',
                'message' => 'Unauthorized'
            ], 401);
        }
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('MyApp')->accessToken;

            return (new UserResource($request->user()))
                ->additional([
                    'data' => [
                        'token' => $token
                    ]
                ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ], 401);
        }
        $role = Role::where('name', 'user')->first();
        $result = new User;
        $result->name = $request->name;
        $result->email = $request->email;
        $result->password = Hash::make($request->password);
        $result->title = "";
        $result->gender = "";
        $result->avatar_url = "";
        $result->avatar_name = "";
        $result->education = "";
        $result->location = "";
        $result->skills = "";
        $result->note = "";
        $result->birthday = "";
        $result->is_active = "";
        $result->phone = "";
        $result->slug = Str::slug($request->name);

        $result->save();
        $result->roles()->attach($role);

        $notification = new Notification();
        $notification->title = 'register account';
        $notification->content =  $result->name . '-' . now();
        $notification->type = '1';
        $notification->url = "register";
        $notification->save();

        $user_notification = new NotificationUser();
        $user_notification->notification_id = $notification->id;
        $user_notification->user_id = $result->id;
        $user_notification->is_read = '0';
        $user_notification->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $registerRequest)
    {
        $req = $registerRequest;
        $result = ['status' => 200];
        try {
            $result['data'] = $this->service->register($req);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return redirect()->route('login')->with('message', 'Tai khoan da duoc dang ky thanh cong, ban co the dang nhap luon');
    }

    public function logout()
    {
        $token =  auth()->guard('api')->user()->token();
        $token->revoke();
        return response()->json([
            'data' => [
                'message' => 'Logout successfully!',
            ],
        ]);
    }

    public function user()
    {
        $user= auth()->guard('api')->user();

        return response()->json(['user' => $user], 200);
    }
}
