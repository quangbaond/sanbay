@extends('layouts.app')
@section('content')
<x-header title="Chi tiết rút tiền" />
<div id="main">
    <table id="" class="table table-bordered">
        <thead>
            <tr>
                <th>Số tiền(VND)</th>
                <th>Phương thức</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ number_format($transaction->amount) }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->status == 0 ? 'Đang chờ' : ($transaction->status == 1 ? 'Thành công' : 'Từ chối') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('includes.footer')
@endsection
