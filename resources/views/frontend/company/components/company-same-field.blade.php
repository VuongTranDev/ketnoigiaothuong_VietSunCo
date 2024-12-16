<div class="company-carousel">
    @for ($i = 0; $i < 10; $i++)
        <div class="company-item">
            <a href="" class="company-link">
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
