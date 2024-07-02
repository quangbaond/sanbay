@extends('layouts.app')
@section('content')
<x-header title="AVG" />
<img src="/static/logo/1.jpg" alt="" style="width:100%">
<div id="login">
    <div class="container">
        <div class="row justify-content-center" style="align-items: center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Đăng Ký') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="username" class="">Số điện thoại</label>

                                <div class="col-12">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="password" class="">Mật khẩu</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="password2" class="">Mật khẩu giao dịch</label>

                                <div class="col-md-12">
                                    <input id="password2" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password2"
                                           required autocomplete="password2">

                                    @error('password2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="company_id" class="">ID công ty</label>

                                <div class="col-md-12">
                                    <input id="company_id" type="text"
                                        class="form-control @error('company_id') is-invalid @enderror" name="company_id"
                                        value="{{ old('company_id') }}" required autocomplete="company_id" autofocus
                                        placeholder="Nhập ID công ty">

                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-cash my-2">
                                {{ __('Đăng Ký') }}
                            </button>
                        </form>
                        @if(session('error'))
                        <div class="alert alert-danger mt-2">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-center" style="align-items: center">
                            <div class="col-12 text-center">
                                Đã có tài khoản ?
                                <a style="color: blue !important" href="{{ route('login') }}">
                                    {{ __('Đăng nhập') }}
                                </a>
                            </div>
                            {{-- <div class="col-6 text-right">
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
