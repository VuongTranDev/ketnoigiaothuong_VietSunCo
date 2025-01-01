@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pt-2 pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
            </ol>
        </nav>

        <h3 class="d-flex justify-content-center mb-4">VỀ CHÚNG TÔI</h3>
    </div>
    <div class="" style="background-color: rgb(247, 240, 240); ">
        <div class="container-xl p-3">
            <h4>CỘNG ĐỒNG KẾT NỐI GIAO THƯƠNG</h4>

            <div class="row">
                <div class="col-md-8">
                    <p style="font-size: 18px; text-align: justify;">Giúp kết nối các doanh nhân, doanh nghiệp đa ngành
                        nghề,
                        đa lĩnh vực giao thương chéo,
                        tạo nền móng vững chắc cho doanh nghiệp Việt phát triển CƠ HỘI, GIA TĂNG doanh số Kinh doanh</p>

                    <p style="font-size: 18px; text-align: justify;">
                        Giúp gia tăng khả năng tạo dựng và phát triển các mối quan hệ kinh doanh dài lâu, bền chặt với nhau
                        đúng đối
                        tượng khách hàng và đối tác
                    </p>

                    <p style="font-size: 18px; text-align: justify;">
                        Giúp phát triển Marketing, kinh doanh thông qua kênh tiếp thị truyền miệng và công nghệ, truyền
                        thông báo
                        đài
                    </p>
                </div>

                <div class="col-md-4">
                    <img src="{{ asset('frontend/image/cooperate.png') }}" alt="Hợp tác" width="100%">
                </div>
            </div>
        </div>

    </div>

    @include('frontend.home.components.criteria-section')

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15677.582167827999!2d106.6984947!3d10.780987!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x22c970ad6ba67f9b%3A0xdab09836018ff41d!2zQ8O0bmcgdHkgVGjGsMahbmcgbeG6oWkgROG7i2NoIHbhu6UgVmlldHN1bmNv!5e0!3m2!1svi!2s!4v1735755121030!5m2!1svi!2s"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection
