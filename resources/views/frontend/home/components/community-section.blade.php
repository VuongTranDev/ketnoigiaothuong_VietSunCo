<div class="container-xl">
    <div class="mt-5 community-group" data-aos="fade-up">
        <h2 class="title-b2b">Cộng đồng kết nối doanh nghiệp</h2>
        <hr class="line-title">
    </div>

    <div class="row">
        @foreach ($companies as $item)
            <div class="col-6 col-lg-3 col-md-3 d-flex company-list">
                <a href="{{ route('company.detail') }}" class="company-link">
                    <div class="company-detail" align="center" data-aos="fade-up">
                        <img src="{{ asset('frontend/image/DaNang.png') }}" alt="Đà Nẵng" class="img-company"
                            loading="lazy">
                        <p class="name-company">{{ $item->company_name }}</p>
                        {{-- <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2" style="font-size: 13px">1231212đ</span>
                        </div> --}}
                    </div>
                </a>
            </div>
        @endforeach

        {{-- @for ($i = 0; $i < 12; $i++)
            <div class="col-6 col-sm-3 col-md-3 d-flex company-list">
                <a href="{{ route('company.detail') }}" class="company-link">
                    <div class="company-detail" align="center" data-aos="fade-up">
                        <img src="{{ asset('frontend/image/DaNang.png') }}" alt="Đà Nẵng" class="img-company"
                            loading="lazy">
                        <p class="name-company">VietSunCo</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2" style="font-size: 13px">1231212đ</span>
                        </div>
                    </div>
                </a>
            </div>
        @endfor --}}
    </div>

    <div class="d-flex d-flex justify-content-center mb-3">
        <div class="btn see-more">
            <a href="{{ route('company.list-company') }}">Xem thêm</a>
        </div>
    </div>
</div>
