<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'userName' => 'required|string|unique:users,userName',
                'email' => 'required|email|unique:users,email',
                'phoneNumber' => 'required|string|regex:/^0[0-9]{9}$/|unique:users,phoneNumber',
                'password' => 'required|string|min:6',
            ], [
                'userName.required' => 'Vui lòng nhập tên người dùng.',
                'userName.unique' => 'Tên người dùng đã tồn tại.',
            
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email đã được sử dụng.',
            
                'phoneNumber.required' => 'Vui lòng nhập số điện thoại.',
                'phoneNumber.regex' => 'Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0 và có 10 chữ số.',
                'phoneNumber.unique' => 'Số điện thoại đã tồn tại.',
            
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]);            
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }
        

        $role = Role::where('roleName', 'User')->first();
        User::create([
            'userName' => $request->userName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password' => Hash::make($request->password),
            'roleId' => $role->roleId,
        ]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Đăng ký thành công',
        ],200);
    }

    public function login(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ], [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không hợp lệ.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'error' => 'Tài khoản hoặc mật khẩu không chính xác!'
            ], 500);
        }

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'token' => $token
        ],200);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Đăng xuất thành công!'
        ]);
    }

    public function me()
    {
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'data' => [
                'userId' => Auth::guard('api')->user()->userId,
                'userName' => Auth::guard('api')->user()->userName,
                'email' => Auth::guard('api')->user()->email,
                'phoneNumber' => Auth::guard('api')->user()->phoneNumber,
                'address' => Auth::guard('api')->user()->address??'',
                'role' => Auth::guard('api')->user()->role->roleName,
            ]
        ]);
    }
}
