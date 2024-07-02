<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $title = 'Đăng nhập';
        return view('auth.login', compact('title'));
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'password.required' => 'Vui lòng nhập mật khẩu',

        ]);

        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        return back()->withErrors([
            'username' => 'Tài khoản hoặc mật khẩu không đúng',
        ]);

    }

    public function register()
    {
        $title = 'Đăng ký';
        return view('auth.register', compact('title'));
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|numeric|digits:10',
            'password' => 'required',
            'company_id' => 'required',
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'username.numeric' => 'Tên đăng nhập phải là số điện thoại',
            'username.digits' => 'Tên đăng nhập phải có 10 chữ số',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'company_id.required' => 'Vui lòng nhập mã công ty',
        ]);

        $setting = Setting::query()->where('key', $request->company_id)->first();
        if (!$setting) {
            return redirect()->back()->with('error', 'Mã công ty không tồn tại');
        }

        User::query()->create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('success', 'Đăng ký thành công');

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flash('success', 'Đăng xuất thành công');
        return redirect()->route('login');
    }
}
