@extends('layouts.app')
@section('content')
<x-header title="Thông tin tài khoản" />
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div id="main" class="p-3">
    <form action="{{ route('add-bank-post') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-group">
        <label for="bank_name">Tên ngân hàng</label>
        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ old('bank_name') }}">
        @error('bank_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="bank_account_name">Tên chủ sở hữu</label>
        <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="{{ old('bank_account_name') }}">
        @error('bank_account_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bank_account">Số tài khoản</label>
        <input type="text" class="form-control" id="bank_account" name="bank_account" value="{{ old('bank_account') }}">
        @error('bank_account')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bank_branch">Chi nhánh</label>
        <input type="text" class="form-control" id="bank_branch" name="bank_branch" value="{{ old('bank_branch') }}">
        @error('bank_branch')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    {{-- // password2 --}}
    <div class="form-group">
        <label for="password2">Mật khẩu giao dịch</label>
        <input type="password" class="form-control" id="password2" name="password2">
        @error('password2')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    {{-- // id_card_before --}}
    <div class="form-group">
        <label for="id_card_before">Ảnh mặt trước CMND</label>
        <input type="file" class="form-control" id="id_card_before" name="id_card_before">
        @error('id_card_before')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    {{-- // id_card_after --}}
    <div class="form-group">
        <label for="id_card_after">Ảnh mặt sau CMND</label>
        <input type="file" class="form-control" id="id_card_after" name="id_card_after">
        @error('id_card_after')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary btn-cash my-2">Cập nhật</button>
    </form>
</div>
@include('includes.footer')

@endsection
