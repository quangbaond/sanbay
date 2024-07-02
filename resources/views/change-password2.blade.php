@extends('layouts.app')
@section('content')
<x-header title="Đổi mật khẩu giao dịch" />
@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
<div id="main" class="p-3">
    <form action="{{ route('change-password2-post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="old_password">Mật khẩu đăng nhập</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password2">Mật khẩu mới</label>
            <input type="password" class="form-control" id="password2" name="password2">
            @error('password2')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="confirm_password2">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirm_password2" name="confirm_password2">
            @error('confirm_password2')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-cash my-2">Cập nhật</button>
    </form>

</div>
    @include('includes.footer')
@endsection
