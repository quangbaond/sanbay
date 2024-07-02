@extends('layouts.app')
@section('content')
<x-header title="Hồ sơ Thu nhập" />
<div id="main">
    <table id="" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên danh mục đấu thầu</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
            </tr>
        </thead>
        <tbody>
        @if($invests->isEmpty())
            <tr>
                <td colspan="4" style="text-align: center">Không có dữ liệu</td>
            </tr>
        @else
        @foreach($invests as $invest) @endforeach
            <tr>
                <td>{{ $invest->product->name }}</td>
                <td>{{ $invest->amount }}</td>
                <td>{{ $invest->status == 0 ? 'Đang chờ' : ($invest->status == 1 ? 'Thành công' : 'Từ chối') }}</td>
                <td>{{ $invest->completed_at }}</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection
