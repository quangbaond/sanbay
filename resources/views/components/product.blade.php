<div class="products">
    <div class="product_title">
        <div id="i"></div>
        <span>{{ $title }}</span>
    </div>
    <div class="product_item my-2">
        <div class="card">
            <img src="{{asset("/storage/{$product->image}")}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">{{ $product->name }}</h6>
                <div class=" row infomation justify-content-center">
                    <div class="col-3">
                        <div><span style="color: #28a3e6; font-size: 14px">{{ $product->profit_everyday }}</span><span>%</span></div>
                        <p >Lợi nhuận</p>
                    </div>
                    <div class="col-3">
                        <div><span style="color: #28a3e6; font-size: 14px">{{ $product->time_invest }} </span><span>Phút</span></div>
                        <p >Ngày</p>
                    </div>
                    <div class="col-6">
                        <div><span style="color: #28a3e6; font-size: 14px">{{ $product->min_invest }}</span><span> đ</span></div>
                        <p style="font-size: 14px">Số tiền đấu thầu</p>
                    </div>
                </div>
                <div class="row justify-content-center" style="align-items: center">
                    <div class="col-8">
                        <div>Quy mô dự án: <span style="color:#28a3e6">{{ number_format($product->amount_total) }}</span><span>đ</span></div>
                    </div>
                    <div class="col-4" style="text-align:right">
                        <a style="color: #fff !important" href="{{ route('product-detail', $product->slug) }}" class="btn btn-primary btn-sm">Đấu thấu</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-3">
                        <span>Tiến độ:</span>
                    </div>
                    <div class="col-5" style="align-content: center">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{$product->progress}}%" aria-valuenow="{{$product->progress}}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-4" style="text-align: right">
                        <span>{{$product->progress}}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
