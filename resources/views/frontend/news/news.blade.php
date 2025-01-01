@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9" style="color: #777;">

                @foreach ($news as $item)
                    <div class="news-group">
                        <a href="{{ route('news.detail', $item->slug) }}" class="news-item d-flex align-items-start p-3 mb-3">
                            <div class="news-image flex-shrink-0">
                                <img src="{{ asset($item->image) }}" alt="News Image" class="img-fluid rounded">
                            </div>
                            <div class="news-content pl-3">
                                <h5 class="news-title font-weight-bold mb-1">{{ $item->title }}</h5>
                                <div class="news-meta text-muted mb-2">
                                    <span class="news-author font-weight-bold">{{ $item->company_name }}</span> - <span class="news-date">{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                </div>
                                <p class="news-description mb-0">
                                    {{ strip_tags($item->content) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{-- Phân trang --}}
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        {{-- Nút Previous --}}
                        <li class="page-item {{ $paginate->current_page == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $paginate->current_page > 1 ? route('news', ['page' => $paginate->current_page - 1]) : '#' }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Các trang --}}
                        @for ($i = 1; $i <= $paginate->total_page; $i++)
                            <li class="page-item {{ $i == $paginate->current_page ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('news', ['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Nút Next --}}
                        <li class="page-item {{ $paginate->current_page == $paginate->total_page ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $paginate->current_page < $paginate->total_page ? route('news', ['page' => $paginate->current_page + 1]) : '#' }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-3" style="color: #777;">
                @include('frontend.news.components.feature-sidebar')
            </div>
        </div>
    </div>
@endsection
