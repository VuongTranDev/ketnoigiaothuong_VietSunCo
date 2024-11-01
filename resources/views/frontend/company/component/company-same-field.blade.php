<div class="company-carousel">
    @for ($i = 0; $i < 10; $i++)
        <div class="company-item">
            <a href="{{ route('company.detail') }}" class="company-link">
                <div class="company-detail" align="center">
                    <img src="{{ asset('frontend/image/DaNang.png') }}" alt="Đà Nẵng" class="img-company" loading="lazy">
                    <p class="name-company">VietSunCo</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2" style="font-size: 13px">1231212đ</span>
                    </div>
                </div>
            </a>
        </div>
    @endfor
</div>


<style>
    .company-item {
        margin: 10px;
        border-radius: 8px;
        transition: transform 0.3s ease;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .company-link {
        text-decoration: none;
        color: inherit;
    }

    .name-company {
        font-size: 16px;
        font-weight: bold;
    }

    .slick-prev,
    .slick-next {
        border: none;
        border-radius: 50px;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
        overflow: hidden;
        z-index: 10;
    }

    .slick-prev {
        left: 20px;
    }

    .slick-next {
        right: 20px;
    }

    .slick-prev:before,
    .slick-next:before {
        font-size: 60px;
        color: #f7f7f7;
        line-height: 1;
    }
</style>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.company-carousel').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        });
    </script>
@endpush
