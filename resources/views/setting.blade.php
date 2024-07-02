@extends('layouts.app')
@section('content')
<x-header title="Cài đặt an toàn" />
<div id="main">
    {{-- <form action="{{ route('setting') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="old_password">Mật khẩu cũ</label>
            <input type="password" class="form-control" id="old_password" name="old_password">
        </div>
        <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form> --}}
    <div class="card mx-2">
        <div class="card-body">
            <div class="row" style="align-items: center">
                <div class="col-2">
                    <img style="width:30px" src="/static/icon/setting/1.png" alt="">
                </div>
                <div class="col-6">
                    <b style="color: #3582b3">Số điện thoại</b>
                </div>
                <div class="col-4">
                    <b style="color: #3582b3">{{ auth()->user()->username }}</b>
                </div>
            </div>
        </div>
    </div>
    <div class="menu mt-3 ">
        <ul class="list-group">
            <li class="list-group-item">
                <div class="row" style="align-items: center">
                    <div class="col-2">
                        <img width="30px" src="/static/icon/setting/2.png" alt="">
                    </div>
                    <div class="col">
                        <b style="color: #3582b3">Xác nhận tên thật</b>
                    </div>
                    <div class="col">
                        <b style="color: green">Đã hoàn thành</b>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <a href="{{ route('change-password') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/setting/3.png" alt="">
                        </div>
                        <div class="col">
                            <b style="color: #3582b3">Thay đổi mật khẩu đăng nhập</b>
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('change-password2') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/setting/4.png" alt="">
                        </div>
                        <div class="col">
                            <b style="color: #3582b3">Thay đổi mật khẩu thanh toán</b>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
@include('includes.footer')
