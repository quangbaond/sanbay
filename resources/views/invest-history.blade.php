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
                <td>
                    @if($invest->status == 0)
                        <span class="badge badge-warning">Đang chờ</span>
                    @elseif($invest->status == 1)
                        <span class="badge badge-success">Đã xác nhận</span>
                    @elseif($invest->status == 2)
                        <span class="badge badge-danger">Thành công</span>
                    @else
                        <span class="badge badge-danger">Thất bại</span>
                    @endif
                </td>
                <td>{{ $invest->created_at }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
@include('includes.footer')
