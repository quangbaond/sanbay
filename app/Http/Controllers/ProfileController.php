<?php

namespace App\Http\Controllers;

use App\Models\HistoryInvest;
use App\Models\Invest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Trang cá nhân';
        return view('profile', compact('title'));
    }

    public function financial()
    {
        $title = 'Chi tiết tài chính';

        $transactions = Transaction::query()->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('financial', compact('title', 'transactions'));
    }

    public function investHisttory()
    {
        $title = 'Đầu tư';

        $invests = Invest::query()->where('user_id', auth()->id())->with('product')
            ->orderBy('completed_at', 'desc')
            ->get();
        return view('invest-history', compact('title', 'invests'));
    }

    public function income()
    {
        $title = 'Thu nhập';

        $invests = Invest::query()->where('user_id', auth()->id())
            ->where('status', 1)
            ->with('product')
            ->orderBy('completed_at', 'desc')
            ->get();
        return view('income', compact('title', 'invests'));
    }

    public function withdrawHistory()
    {
        $title = 'Lịch sử rút tiền';
        $transactions = Transaction::query()->where('user_id', auth()->id())
            ->where('type', 2)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('withdraw-history', compact('title', 'transactions'));
    }

    public function depositHistory()
    {
        $title = 'Lịch sử nạp tiền';
        $transactions = Transaction::query()->where('user_id', auth()->id())
            ->where('type', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('deposit-history', compact('title', 'transactions'));
    }

    public function setting()
    {
        $title = 'Cài đặt';
        return view('setting', compact('title'));
    }

    public function changePassword()
    {
        $title = 'Đổi mật khẩu';
        return view('change-password', compact('title'));
    }

    public function changePassword2()
    {
        $title = 'Đổi mật khẩu';
        return view('change-password2', compact('title'));
    }

    public function settingBank()
    {
        $title = 'Cài đặt ngân hàng';
        return view('setting-bank', compact('title'));
    }

    public function addBank()
    {
        $title = 'Thêm ngân hàng';
        return view('addbank', compact('title'));
    }

    public function addBankPost(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'bank_account' => 'required',
            'bank_branch' => 'required',
            'bank_account_name' => 'required',
            'password2' => 'required',
            'id_card_before' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_card_after' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'bank_name.required' => 'Vui lòng nhập tên ngân hàng',
            'bank_account.required' => 'Vui lòng nhập số tài khoản',
            'bank_branch.required' => 'Vui lòng nhập chi nhánh',
            'bank_account_name.required' => 'Vui lòng nhập tên chủ tài khoản',
            'password2.required' => 'Vui lòng nhập mật khẩu giao dịch',
            'id_card_before.required' => 'Vui lòng chọn ảnh mặt trước CMND',
            'id_card_before.image' => 'Ảnh mặt trước CMND không đúng định dạng',
            'id_card_before.mimes' => 'Ảnh mặt trước CMND phải là ảnh jpeg, png, jpg, gif, svg',
            'id_card_before.max' => 'Ảnh mặt trước CMND không quá 2MB',
            'id_card_after.required' => 'Vui lòng chọn ảnh mặt sau CMND',
            'id_card_after.image' => 'Ảnh mặt sau CMND không đúng định dạng',
            'id_card_after.mimes' => 'Ảnh mặt sau CMND phải là ảnh jpeg, png, jpg, gif, svg',
            'id_card_after.max' => 'Ảnh mặt sau CMND không quá 2MB',

        ]);

        //check password2
        $isValidPassword = Hash::check($request->password2, auth()->user()->password2);
        if (!$isValidPassword) {
            return redirect()->back()->with('error', 'Mật khẩu giao dịch không đúng');
        }

        $user = User::query()->find(auth()->id());

        $user->banks()->create([
            'bank_name' => $request->bank_name,
            'bank_account' => $request->bank_account,
            'bank_branch' => $request->bank_branch,
            'bank_account_name' => $request->bank_account_name,
            'id_card_before' => $request->file('id_card_before')->store('id_card', 'public'),
            'id_card_after' => $request->file('id_card_after')->store('id_card', 'public'),
        ]);

        return redirect()->route('setting-bank');
    }

    public function withdrawPost(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'password2' => 'required',
            'bank_id' => 'required|exists:user_banks,id',
        ], [
            'bank_id.exists' => 'Ngân hàng không tồn tại',
            'bank_id.required' => 'Vui lòng chọn ngân hàng',
            'amount.required' => 'Vui lòng nhập số tiền',
            'amount.numeric' => 'Số tiền phải là số',
            'password2.required' => 'Vui lòng nhập mật khẩu giao dịch',
        ]);


        $isValidPassword = Hash::check($request->password2, auth()->user()->password2);

        if (!$isValidPassword) {
            return redirect()->back()->with('error', 'Mật khẩu giao dịch không đúng');
        }

        $user = User::query()->find(auth()->id());
        if ($user->balance < $request->amount) {
            return redirect()->back()->with('error', 'Số dư không đủ');
        }

        $user->balance -= $request->amount;
        $user->save();

        $user->transactions()->create([
            'amount' => $request->amount,
            'type' => 2,
            'user_bank_id' => $request->bank_id,
            'status' => 0,
            'note' => 'Rút tiền',
            'payment_method' => 'Ngân hàng',
        ]);

        return redirect()->route('withdraw-history')->with('success', 'Rút tiền thành công, vui lòng chờ xác nhận từ admin');
    }

    public function changePasswordPost(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            'confirm_password.same' => 'Mật khẩu mới không khớp',
        ]);

        $isValidPassword = Hash::check($request->old_password, auth()->user()->password);

        if (!$isValidPassword) {
            return redirect()->back()->with('error', 'Mật khẩu cũ không đúng');
        }

        $user = User::query()->find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('change-password')->with('success', 'Đổi mật khẩu thành công');
    }

    public function changePassword2Post(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password2' => 'required',
            'confirm_password2' => 'required|same:password2',
        ], [
            'password.required' => 'Vui lòng nhập mật đăng nhập',
            'password2.required' => 'Vui lòng nhập mật khẩu mới',
            'confirm_password2.required' => 'Vui lòng nhập lại mật khẩu mới',
            'confirm_password2.same' => 'Mật khẩu mới không khớp',
        ]);

        $isValidPassword = Hash::check($request->password, auth()->user()->password);

        if (!$isValidPassword) {
            return redirect()->back()->with('error', 'Mật khẩu đăng nhập không đúng');
        }

        $user = User::query()->find(auth()->id());
        $user->password2 = Hash::make($request->password2);
        $user->save();

        return redirect()->route('change-password2')->with('success', 'Đổi mật khẩu giao dịch thành công');
    }
}
