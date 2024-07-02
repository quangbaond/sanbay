@extends('layouts.app')
@section('content')
<x-header title="Thông tin tài khoản" />
<div id="main" class="p-3">
    @if(auth()->user()->banks->count() == 0)
        <p>Không có dữ liệu</p>
    @else
    @foreach(auth()->user()->banks as $bank) @endforeach
    <div class="card">
        <div class="card-body">
            <div class="row" style="align-items: center">
                <p>Tên chủ sở hữu: {{ $bank->bank_account_name }}</p>
                <p>Số tài khoản: {{ $bank->bank_account }}</p>
                <p>Ngân hàng: {{ $bank->bank_name }}</p>
                <p>Chi nhánh: {{ $bank->bank_branch }}</p>
            </div>
        </div>
        {{-- //action --}}
        <div class="card-footer">
            <a class="btn btn-danger w-100" style="color: #fff !important">Xóa</a>
        </div>
    </div>

    @endif
        <div class="">
            <a href="{{ route('add-bank') }}" style="color: #fff !important" class="btn btn-primary btn-cash">Thêm tài khoản</a>
        </div>
</div>
@include('includes.footer')
@endsection
