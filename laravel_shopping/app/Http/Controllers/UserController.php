<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Traits\StorageImage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use StorageImage;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $searchTerm = $request->get('search');
        $users = UserResource::collection($this->userService->getAll($searchTerm));

        $count = $users->resource->lastPage();
        $currentPage = $users->resource->currentPage();
        $previous = $currentPage - 1;
        if ($previous == 0) {
            $previous = $currentPage;
        }
        $next = $currentPage + 1;
        if ($next == $count) {
            $next = $currentPage;
        }
        $data = [
            'users' => $users,
            'count' => $count,
            'currentPage' => $currentPage,
            'previous' => $previous,
            'next' => $next
        ];

        return response()->json($data);
    }

    public function create()
    {
        // $gender = User::GENDER;
        // $status = User::STATUS;
        // $role = User::ROLE;

        return view('admin.user.user_add', compact('gender', 'status', 'role'));
    }

    public function store(UserRequest $userRequest)
    {
        $req = $userRequest;

        $users = ['status' => 200];

        try {
            $users['data'] = $this->userService->create($req);
        } catch (Exception $e) {
            $users = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($users, $users['status']);

    }

    public function edit($slug)
    {
        $user = $this->userService->getSingle($slug);
        foreach ($user->roles as $roleUser) {
            $role = $roleUser->name;
        }

        $data = [
            'user' => $user,
            'role' => $role
        ];

        return response()->json($data);

    }

    public function update(UserRequest $userRequest, $id)
    {

        $req = $userRequest;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->userService->update($id, $req);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
        // return redirect()->route('user.list')->with('success', 'Tài khoản người dùng đã được cập nhật thành công');
    }

    public function delete($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->userService->delete($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function search(Request $request)
    {
        $data = $request->get('data');

        $nameUser = User::where('name', 'like', "%{$data}%")
            ->orWhere('name', 'like', "%{$data}%")
            ->get();

        return response()->json([
            'data' => $nameUser
        ]);
    }

    public function profile()
    {
        foreach (Auth::user()->roles as $role) {
            if ($role->name == "admin") {
                return view('admin.user.profile');
            }
            if ($role->name == "user") {
                return view('auth.profile');
            }
        }
        return view('auth.profile');
    }

    public function editProfile($id)
    {
       $data= $this->userService->editProfile($id);
        
        return response()->json($data);
    }

    public function updateProfile(Request $request ,$id)
    {
        $req = $request;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->userService->updateProfile($req,$id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result,$result['status']);
    }

    public function showChangePassword(Request $request)
    {
        dd($request->user()->name);
        return view('auth.change-password');
    }

    public function changePassword(Request $request, $id)
    {
        $user= User::where('id',$id)->first();
        $this->validate($request, [
            'oldpassword' => 'required|min:6|max:12',
            'password' => 'required|min:6|max:12|confirmed',
        ]);

        $hashedPassword = $user->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            if (Hash::check($request->password, $hashedPassword)) {
               return response()->json(['error'=>'mat khau moi trung mat khau cu']);
            }
            if ($request->password != $request->oldpassword) {
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['data'=>'ok'],200);
            }
        }
        return response()->json(['error'=>'mat khau khong chinh xac']);
    }
}
