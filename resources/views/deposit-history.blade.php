@extends('layouts.app')
<x-header title="Chi tiết nạp tiền" />
<div id="main">
    <table id="" class="table table-bordered">
        <thead>
            <tr>
                <th>Số tiền nạp(VND)</th>
                <th>Phương thức nạp tiền</th>
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
                <td>{{ $transaction->status == 0 ? 'Đang chờ' : ($transaction->status == 1 ? 'Đã nạp' : 'Từ chối') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
