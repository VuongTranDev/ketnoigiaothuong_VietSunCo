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
                <li class="breadcrumb-item active" aria-current="page">Danh sách công ty</li>
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
                    @foreach ($companies as $item)
                        <div class="col-6 col-lg-4 col-md-4 d-flex company-list">
                            <a href="{{ route('company.detail', $item->slug) }}" class="company-link">
                                <div class="company-detail" align="center" data-aos="fade-up">
                                    <img src="{{ asset($item->image) }}" alt="Đà Nẵng" class="img-company" loading="lazy">
                                    <p class="name-company">{{ $item->company_name }}</p>
                                    <p class="short-name">{{ $item->short_name }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Phân trang --}}
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">

                        <li class="page-item {{ $paginate->current_page == 1 ? 'disabled' : '' }}">
                            <a class="page-link"
                                href="{{ $paginate->current_page > 1 ? route('company.list-company', ['page' => $paginate->current_page - 1]) : '#' }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        @for ($i = 1; $i <= $paginate->total_page; $i++)
                            <li class="page-item {{ $i == $paginate->current_page ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ route('company.list-company', ['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="page-item {{ $paginate->current_page == $paginate->total_page ? 'disabled' : '' }}">
                            <a class="page-link"
                                href="{{ $paginate->current_page < $paginate->total_page ? route('company.list-company', ['page' => $paginate->current_page + 1]) : '#' }}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
