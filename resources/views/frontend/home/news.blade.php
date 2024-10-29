@extends('FontEnd.layout.app')

@section('renderBody')
    <div class="container-xl">
        <div class="mt-5 community-group">
            <h2 class="title-b2b">Cộng đồng kết nối doanh nghiệp</h2>
            <hr class="line-title">
        </div>

        <div class="row">
            @for ($i = 0; $i < 12; $i++)
                <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                    <div class="product-detail" align="center" data-aos="fade-up" data-aos-duration="800">
                        <img src="{{ URL('FontEnd/image/DaNang.png') }}" alt="Đà Nẵng" class="img-product">
                        <p class="name-product">VietSunCo</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2" style="font-size: 13px">1231212đ</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="d-flex d-flex justify-content-center mb-3">
            <div class="btn see-more">
                <a href="/">Xem thêm</a>
            </div>
        </div>
    </div>
@endsection
