@extends('layouts.app')
<div id="main">
<div class="information_profile" id="">
    <p>Tài khoản của tôi: {{ auth()->user()->username }}</p>
    <div class="balance" style="text-align:center">
        <b style="font-size: 30px">{{ number_format(auth()->user()->balance) }}</b>
        <p>Số dư tài khoản (VNĐ)</p>
    </div>

{{--    <div class="footer" style="text-align: center">--}}
{{--        <div class="row">--}}
{{--            <div class="col-6">--}}
{{--                <b>0</b>--}}
{{--                <p>Tiền lãi sẽ được nhận (VNĐ)</p>--}}
{{--            </div>--}}
{{--            <div class="col-6">--}}
{{--                <b>0</b>--}}
{{--                <p>Số tiền gốc sẽ được nhận (VNĐ)</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

</div>
<div class="deposit px-3">
    <div class="row py-3">
        <div class="col-6">
            <a style="color: #fff !important;" href="{{route('desposit')}}" type="button" class="btn btn-primary btn-cash">Nạp tiền</a>
        </div>
        <div class="col-6">
            <a style="color: #fff !important;" href="{{route('withdraw')}}" type="button" class="btn btn-primary btn-cash">Rút tiền</a>
        </div>
    </div>
</div>
<div class="">
    <div class="menu ">
        <ul class="list-group">
{{--            <li class="list-group-item">--}}
{{--                <div class="row" style="align-items: center">--}}
{{--                    <div class="col-2">--}}
{{--                        <img width="30px" src="/static/icon/profile/1.png" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        <b>Đăng ký hàng ngày</b>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li class="list-group-item">--}}
{{--                <a href="{{ route('financial') }}">--}}
{{--                    <div class="row" style="align-items: center">--}}
{{--                        <div class="col-2">--}}
{{--                            <img width="30px" src="/static/icon/profile/2.png" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <b>Chi tiết tài chính</b>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="list-group-item">
                <a href="{{ route('invest-history') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/profile/3.png" alt="">
                        </div>
                        <div class="col">
                            <b>Hồ sơ đấu thầu</b>
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('income') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/profile/4.png" alt="">
                        </div>
                        <div class="col">
                            <b>Hồ sơ thu nhập</b>
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('deposit-history') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/profile/5.png" alt="">
                        </div>
                        <div class="col">
                            <b>Chi tiết nạp tiền</b>
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('withdraw-history') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/profile/6.png" alt="">
                        </div>
                        <div class="col">
                            <b>Hồ sơ rút tiền</b>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="menu mt-3 ">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('setting') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/profile/7.png" alt="">
                        </div>
                        <div class="col">
                            <b>Bảo mật tài khoản</b>
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('setting-bank') }}">
                    <div class="row" style="align-items: center">
                        <div class="col-2">
                            <img width="30px" src="/static/icon/profile/8.png" alt="">
                        </div>
                        <div class="col">
                            <b>Thông tin tài khoản nhận tiền</b>
                        </div>
                    </div>
                </a>

            </li>
        </ul>
    </div>
    <div class="menu mt-3 ">
        <ul class="list-group">

            <li class="list-group-item">
                <a style="color: #fff !important;" class="btn btn-primary btn-cash" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    Đăng xuất
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>
</div>


@include('includes.footer')
