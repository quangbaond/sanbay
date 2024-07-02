@extends('layouts.app')
<x-header title="Lịch sử đầu tư" />
@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div id="main">
    <table id="" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên danh mục đấu thầu</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Ngày</th>
            </tr>
        </thead>
        <tbody>
        @foreach($invests as $invest)
            <tr>
                <td>
                    <a style="color: #0a53be !important;" href="{{route('product-detail', $invest->product->slug)}}">
                        {{ $invest->product->name }}
                    </a>
                </td>
                <td>{{ number_format($invest->amount) }} VND</td>
                <td>{{ $invest->status == 0 ? 'Đang chờ' : ($invest->status == 1 ? 'Xác nhận' : 'Từ chối') }}</td>
                <td>{{ $invest->created_at }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
@include('includes.footer')
