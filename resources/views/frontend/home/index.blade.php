<div class="w-100">
    <img src="{{ asset('frontend/image/background.png') }}" alt="" width="100%" height="550px"
        style="opacity: 1; z-index: 0; position: relative;">
    <div class="container-xl">
        <div class="banner-thumb row">
            <div class="banner-slogan col-lg-7">
                <p class="title-banner">Kết nối các doanh nghiệp</p>
                <p class="content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem alias natus
                    dolore tempore dignissimos neque accusantium cupiditate distinctio libero sit autem deserunt,
                    deleniti consequatur eveniet a, id nobis sapiente blanditiis. Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Voluptatem alias natus
                    dolore tempore dignissimos neque accusantium cupiditate distinctio libero sit autem deserunt,
                    deleniti consequatur eveniet a, id nobis sapiente blanditiis.
                </p>
                <div class="register-member btn">
                    <a href="#">Đăng ký thành viên</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl">
    <div class="border-radius-top-left-right">
    </div>

    <div class="mt-3">
        <div class="row">
            <div>
                <h2 class="title-b2b">Kết nối giao thương là gì?</h2>
                <hr class="line-title">
            </div>
            <p class="col-lg-8" style="text-align: justify;" data-aos="fade-right">Lorem ipsum dolor sit amet,
                consectetuer adipiscing elit.
                Maecenas porttitor congue massa. Fusce posuere,
                magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna. Nunc
                viverra imperdiet enim. Fusce est.</br></br>
                Vivamus a tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas. Proin pharetra nonummy pede. Mauris et orci. Aenean nec lorem.
                In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae,
                pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
            </p>
            <img src="{{ asset('frontend/image/whatb2b.png') }}" alt="Kết nối giao thương là gì?" class="col-lg-4"
                width="100%" data-aos="fade-left">
            <div class="btn see-more ms-2" data-aos="fade-up">
                <a href="/">Xem thêm</a>
            </div>
        </div>

        <div class="row mt-5">
            <img src="{{ asset('frontend/image/b2b.png') }}" alt="Kết nối giao thương là gì?" class="col-lg-4"
                width="100%" data-aos="fade-right">
            <div class="col-lg-8" data-aos="fade-left">
                <h2 class="title-b2b">Cách thức hoạt động</h2>
                <hr class="line-title">
                <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas
                    porttitor congue massa. Fusce posuere,
                    magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
                    Nunc
                    viverra imperdiet enim. Fusce est.</br></br>
                    Vivamus a tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                    turpis
                    egestas. Proin pharetra nonummy pede. Mauris et orci. Aenean nec lorem.
                    In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae,
                    pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
                </p>
                <div class="btn see-more">
                    <a href="/">Chi tiết</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w-100 mt-5 mb-3" style="background-color: #CFEBFC; " data-aos="fade-up">
    <div class="container-xl">
        <div class="row pt-4 pb-4">
            <div class="col-lg-4 d-flex flex-column align-items-center" data-aos="fade-up">
                <img src="{{ asset('frontend/image/chart.png') }}" alt="" width="50" class="mb-3">
                <p style="font-weight: 700; color: #ec8f00;">TẦM NHÌN DOANH NGHIỆP</p>
                <p style="text-align: center;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt
                    aspernatur quaerat, libero
                    voluptatem</p>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center" data-aos="fade-up">
                <img src="{{ asset('frontend/image/contract.png') }}" alt="" width="50" class="mb-3">
                <p style="font-weight: 700; color: #ec8f00;">SỨ MỆNH CỦA CHÚNG TÔI</p>
                <p style="text-align: center;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt
                    aspernatur quaerat, libero
                    voluptatem</p>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center" data-aos="fade-up">
                <img src="{{ asset('frontend/image/dimond.png') }}" alt="" width="50" class="mb-3">
                <p style="font-weight: 700; color: #ec8f00;">GIÁ TRỊ CỐT LÕI</p>
                <p style="text-align: center;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt
                    aspernatur quaerat, libero
                    voluptatem</p>
            </div>
        </div>
    </div>
</div>

<div class="container-xl">
    <div class="mt-5 community-group" data-aos="fade-up">
        <h2 class="title-b2b">Cộng đồng kết nối doanh nghiệp</h2>
        <hr class="line-title">
    </div>

    <div class="row">
        @for ($i = 0; $i < 12; $i++)
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
        @endfor
    </div>

    <div class="d-flex d-flex justify-content-center mb-3">
        <div class="btn see-more">
            <a href="{{ route('company.list-company') }}">Xem thêm</a>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
