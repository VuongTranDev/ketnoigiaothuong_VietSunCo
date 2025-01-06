<div class="container-xl">
    <div class="mt-5 community-group" data-aos="fade-up">
        <h2 class="title-b2b">Cộng đồng kết nối doanh nghiệp</h2>
        <hr class="line-title">
    </div>

    <div class="row">
        @foreach ($companies as $item)
            <div class="col-6 col-lg-3 col-md-3 d-flex company-list">
                <a href="{{ route('company.detail', $item->slug) }}" class="company-link">
                    <div class="company-detail" align="center" data-aos="fade-up">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->company_name }}" class="img-company"
                            loading="lazy">
                        <p class="name-company">{{ $item->company_name }}</p>
                        <p class="short-name">{{ $item->short_name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="d-flex d-flex justify-content-center mb-3">
        <a class="see-more" href="{{ route('company.list-company') }}">Xem thêm</a>
    </div>
</div>
