@extends('frontend.layout.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/filter.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/company.css') }}"> --}}
@endpush

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pt-2 pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách công ty tìm được</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-3">
                @include('frontend.company.components.filter-sidebar')
            </div>

            <div class="col-lg-9">
                <div class="d-flex justify-content-end">
                    <div class="search-bar-field">
                        <input type="text" placeholder="Nhập từ khóa tìm kiếm ...">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    @if ($companiesData && count($companiesData) > 0)
                        @foreach ($companiesData as $item)
                            <div class="col-6 col-lg-4 col-md-4 d-flex company-list">
                                <a href="{{ route('company.detail') }}" class="company-link">
                                    <div class="company-detail" align="center" data-aos="fade-up">
                                        <img src="{{ asset('frontend/image/DaNang.png') }}" alt="Đà Nẵng"
                                            class="img-company" loading="lazy">
                                        <p class="name-company">{{ $item->company_name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <h3>Hiện không có công ty nào ở lĩnh vực này.</h3>
                        </div>
                    @endif
                </div>

                <nav aria-label="Page navigation example ">
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
        </div>
    </div>
@endsection
