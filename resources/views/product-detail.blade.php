@extends('layouts.app')
<div>
    <x-header title="Chi tiết đấu thầu"/>
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
    <div id="main" >
        <div class="card">
            <div class="card-body">
                <div class="row mx-2 p-2" style="justify-content: center; text-align:center; background: #f5f5f5; border-radius:10px">
                    <div class="col-6">
                        <p style="font-size: 18px">Mỗi cổ tức</p>
                        <p><span style="color: #3582b3;font-size: 18px">{{ number_format($product->amount_invested) }}</span><span> VND</span></p>
                    </div>
                    <div class="col-6">
                        <p style="font-size: 18px">Chu kì đấu thầu</p>
                        <p><span style="color: #3582b3;font-size: 18px">{{ $product->time_invest }}</span> <span>Phút</span></p>
                    </div>
                </div>
                <hr>
                <p>Phương pháp chia lợi nhuận：Trả gốc và lãi khi đáo hạn</p>
                <hr>
                <p>Số tiền đấu thầu tối thiểu：{{number_format($product->min_invest)}} VND</p>
                <hr>
                <p>Đấu thầu không có rủi ro： {{ $product->interest_risk }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 style="color: #3582b3; text-align: center">Chi tiết đấu thầu</h5>
                <hr>
                <table class="table-bordered table">
                    <tr>
                        <td style="width: 118px">Tên danh mục đấu thầu</td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td>Số tiền dự án：</td>
                        <td style="color: red">{{ $product->amount_invested }} VND</td>
                    </tr>
                    <tr>
                        <td>Số tiền đấu thầu：</td>
                        <td style="color: red">
                            <span>
                                Đấu thầu thấp nhất {{number_format($product->min_invest)}} VND
                            </span>
                            <span style="color: #000"> （Giới hạn mua 9999 phần）</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Thời hạn của dự án：</td>
                        <td style="color: red">
                            <span>
                                {{ $product->time_invest }}
                            </span>
                            <span style="color: #000">Phút</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Tính toán lợi nhuận：</td>
                        <td style="color: red">
                            <span>
                               {{ $product->profit_calculation }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Phương pháp đổi khoản：</td>
                        <td>
                            <span>
                                Trả gốc và lãi khi đáo hạn
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Thời gian giải quyết：</td>
                        <td >
                            <span>
                                {{ $product->times_invest_decision }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Số đấu thầu：</td>
                        <td>
                            <span>
                                {{ $product->book_invest }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Bảo mật：</td>
                        <td >
                            <span>
                                {{ $product->security }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Bản tóm tắt dự án：</td>
                        <td>
                            <span>
                                {{ $product->sort_description }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="action">
        <form action="{{route('invest')}}" method="POST" style="margin-bottom: 0">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="product_id">
            <button type="submit" class="btn btn-primary btn-cash">Đầu tư ngay</button>
        </form>
    </div>
</div>
