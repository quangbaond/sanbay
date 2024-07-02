@extends('layouts.app')
@section('content')
<x-header title="Rút tiền"/>
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
<div id="main">
    <div class="row px-3">
        <div class="col-12">
            @if(auth()->user()->banks->count() == 0)
                <div class="alert alert-danger">Bạn chưa có ngân hàng nào, vui lòng thêm thông tin ngân hàng trước khi rút tiền
                    <a href="{{route('setting-bank')}}" class="d-block">Thêm thông tin ngân hàng</a>
                </div>

            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rút tiền</h5>
                    <div class="form">
                        <form action="{{ route('withdraw-post') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="bank" class="">Chọn ngân hàng</label>
                                <div class="col-12">
                                    <select class="form-control" id="bank" name="bank_id">
                                        @foreach(auth()->user()->banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->bank_name . '-'. $bank->bank_account_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bank_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="">Số tiền</label>
                                <div class="col-12">
                                    <input name="amount" type="number" class="form-control" id="amount" placeholder="Số tiền">
                                </div>
                                @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="password2" class="">Mật khẩu giao dịch</label>
                                <div class="col-12">
                                    <input name="password2" type="password" class="form-control" id="password2">
                                </div>
                                @error('password2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-cash mt-3">Rút tiền</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
