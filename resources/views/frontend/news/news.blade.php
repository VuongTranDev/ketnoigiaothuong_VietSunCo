@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pt-5 pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9 col-9" style="color: #777;">
                @for ($i = 1; $i < 10; $i++)
                    <div class="news-group">
                        <a href="{{ route('news.detail') }}">
                            <img class="img-news" src="{{ asset('frontend/image/media.jpg') }}" alt="">
                        </a>
                        <div class="group-content">
                            <a href="#ádas">
                                <h4>Lorem, ipsum dolor sit amet</h4>
                                <p class="author-news"><b><a href="{{ route('news.detail') }}">VietSunCo</a></b> - 02/10/2024</p>
                                <p class="content-news">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Sapiente
                                    maiores
                                    temporibus id dolor harum dolores ab rerum atque aliquid, doloribus accusantium
                                    sed
                                    nisi...
                                </p>
                            </a>
                        </div>
                    </div>
                    <hr class="line-news">


                    {{-- <div class="col-6 col-sm-3 col-md-3 d-flex company-list">
                        <div class="company-detail" align="center" data-aos="fade-up">
                            <a href="{{ route('company.detail') }}" class="company-link">
                                <img src="{{ asset('frontend/image/DaNang.png') }}" alt="Đà Nẵng" class="img-company"
                                    loading="lazy">
                                <p class="name-company">VietSunCo</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="me-2" style="font-size: 13px">1231212đ</span>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                @endfor

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-3 col-3" style="color: #777;">
                @for ($i = 1; $i < 5; $i++)
                    <div class="news-suggest d-flex flex-column">
                        <img src="{{ asset('frontend/image/media.jpg') }}" alt="">
                        <p class="content-news">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam deleniti
                            accusamus possimus iure
                            porro...
                        </p>
                        <hr class="line-news">
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
