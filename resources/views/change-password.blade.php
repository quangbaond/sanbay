@extends('layouts.app')
@section('content')
<x-header title="Đổi mật khẩu" />
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
    <form action="{{ route('change-password-post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="old_password">Mật khẩu cũ</label>
            <input type="password" class="form-control" id="old_password" name="old_password">
            @error('old_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            @error('confirm_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-cash my-2">Cập nhật</button>
    </form>

</div>
@include('includes.footer')
@endsection
