<div class="w-100">
    <img class="bg-main" src="{{ asset('frontend/image/background.png') }}" alt="">
    <div class="container-xl">
        <div class="banner-thumb row">
            <div class="banner-slogan col-lg-6">
                <p class="title-banner">Kết nối các doanh nghiệp</p>
                <p class="content">
                    "Kết nối giao thương – Mở rộng quan hệ, nâng tầm giá trị!". Gia nhập cộng đồng để đưa doanh nghiệp
                    bạn
                    đến gần hơn với hàng ngàn đối tác tiềm năng, gia tăng cơ hội hợp tác và phát triển bền vững. Tham
                    gia ngay để chinh phục những thành công mới cùng chúng tôi!
                </p>
                <div class="register-member btn">
                    <a href="{{ route('checkStatusCompany') }}">

                        Đăng ký thành viên

                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="border-radius-top-left-right">
    </div>
</div>

@include('frontend.home.components.overview-section')

@include('frontend.home.components.criteria-section')

@include('frontend.home.components.community-section')

@push('script')
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
@endpush
