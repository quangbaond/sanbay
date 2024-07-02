@extends('layouts.app')
@section('content')
<x-header title="Dự án"/>
<div id="main" class="my-2">
    @foreach($products as $product)
        <x-product :title="'Quỹ xây dựng trang thiết bị'" :product="$product"/>
    @endforeach
</div>
    @include('includes.footer')
@endsection
