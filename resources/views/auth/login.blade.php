@extends('layouts.app')
@section('content')
<x-header title="AVG" />
<img src="/static/logo/1.jpg" alt="" style="width:100%">
@if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
@endif
<div id="login">
    <div class="container">
        <div class="row justify-content-center" style="align-items: center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Đăng nhập') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-3 col-form-label text-md-right">Số điện thoại</label>

                                <div class="col-md-9">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="password" class="col-md-3 col-form-label text-md-right">Mật khẩu</label>

                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                         required autocomplete="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-cash my-2">
                                {{ __('Đăng nhập') }}
                            </button>
                        </form>
                    </div>

                    <div class="card-footer">
                        <div class="row justify-content-center" style="align-items: center">
                            <div class="col-12 text-center">
                                Chưa có tài khoản ?
                                <a style="color: blue !important" href="{{ route('register') }}">
                                    {{ __('Đăng ký') }}
                                </a>
                            </div>
                            {{-- <div class="col-6 text
                            -right">
                                <a href="{{ route('password.request') }}" class="btn btn-link">
                                    {{ __('Quên mật khẩu') }}
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
