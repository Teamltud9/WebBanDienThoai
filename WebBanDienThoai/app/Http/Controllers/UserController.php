<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function getAllUser(Request $request)
    {
        $pageSize = $request-> pageSize;
        $page = $request->page ?? 1;
        $query = User::where('isDeleted', false)
                    ->whereHas('role', function ($query) {
                        $query->where('roleName', '!=', 'Admin');
                    });
        if ($pageSize) {
            $users = $query->paginate($pageSize, ['*'], 'page', $page);
            
        } else {
            $users = $query->get(); 
        }
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'result' => $users
        ]);
    }


    public function updateProfile(Request $request)
    {

        $user = Auth::guard('api')->user();
        try {
            $request->validate([
                'userName' => 'string|unique:users,userName',
                'email' => 'email|unique:users,email',
                'phoneNumber' => 'string|regex:/^0[0-9]{9}$/|unique:users,phoneNumber',
                'password' => 'string|min:6',
            ], [

                'userName.unique' => 'Tên người dùng đã tồn tại.',
            
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email đã được sử dụng.',
            
                'phoneNumber.regex' => 'Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0 và có 10 chữ số.',
                'phoneNumber.unique' => 'Số điện thoại đã tồn tại.',
            
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]);            
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 500,
                'time' => now()->toISOString(),
                'errors' => $e->errors()
            ], 500);
        }

        $password = $request->password ? Hash::make($request->password) : $user->password;
        User::where('userId', $user->userId)->update([
            'userName' => $request->userName?? $user->userName,
            'email' => $request->email?? $user->email,
            'phoneNumber' => $request->phoneNumber?? $user->phoneNumber,
            'address' => $request->address??$user->address,
            'password' => $password,
        ]);

        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Cập nhật thông tin thành công!',
        ]);
    }


    public function deleteUser($userId)
    {
        $user = User::where('userId', $userId)->first();

        if (!$user) {
            return response()->json([
                'code' => 404,
                'time' => now()->toISOString(),
                'error' => 'Không tìm thấy người dùng!'
            ], 404);
        }

        $user->update([
            'isDeleted' => true
        ]);
        return response()->json([
            'code' => 200,
            'time' => now()->toISOString(),
            'message' => 'Người dùng đã bị xóa!'
        ]);
    }
}
