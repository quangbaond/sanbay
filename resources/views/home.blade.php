@extends('layouts.app')
@section('content')
@include('includes.banner')
<div id="main">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3" style="text-align: center">
                    <a href="{{ route('invest') }}">
                        <img src="/static/icon/icon-01.png" alt="">
                        <p>Dự án</p>
                    </a>
                </div>
                <div class="col-3" style="text-align: center">
                    <a href="{{ route('about') }}">
                        <img src="/static/icon/icon-02.png" alt="">
                        <p>Giới thiệu</p>
                    </a>
                </div>
                <div class="col-3" style="text-align: center">
                    <a href="{{ route('profile') }}">
                        <img src="/static/icon/icon-03.png" alt="">
                        <p>Số dư</p>
                    </a>
                </div>
                <div class="col-3" style="text-align: center">
                    <a href="{{ route('desposit') }}">
                        <img src="/static/icon/icon-04.png" alt="">
                        <p>Nạp tiền</p>
                    </a>
                </div>
                <div class="col-3" style="text-align: center">
                    <a href="{{ route('withdraw') }}">
                        <img src="/static/icon/icon-05.png" alt="">
                        <p>Rút tiền</p>
                    </a>
                </div>
                <div class="col-3" style="text-align: center">
                    <a href="{{route('profile')}}">
                        <img src="/static/icon/icon-06.png" alt="">
                        <p>Tài khoản</p>
                    </a>

                </div>
                <div class="col-3" style="text-align: center">
                    <a href="{{ route('invest') }}">
                        <img src="/static/icon/icon-07.png" alt="">
                        <p>Đấu thầu</p>
                    </a>

                </div>
                <div class="col-3" style="text-align: center">
                    <img src="/static/icon/icon-08.png" alt="">
                    <p>Hỗ trợ</p>
                </div>
            </div>
        </div>
    </div>
    <div class="notification">
        <div class="icon">
            <img src="/static/icon/loa.png" alt="">
        </div>
        <div>
            <marquee behavior="" direction="">Chào mừng quý khách đến với dự án quỹ dự án Cảng Hàng Không Quốc Tế</marquee>
        </div>


    </div>
    @foreach($products as $product)
        <x-product :title="'Các quỹ đấu thầu'" :product="$product"/>

    @endforeach
    @include('includes.footer')
</div>
@endsection
