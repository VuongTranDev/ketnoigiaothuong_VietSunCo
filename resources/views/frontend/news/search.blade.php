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
                @if (count($news) === 0)
                    <div class="row">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>Rất tiếc không tìm thấy tin tức nào!</h3>
                            </div>
                        </div>
                    </div>
                @else
                    <h4 class="mt-3 mb-3" style="color: #333;">Tìm thấy <b>{{ count($news) }}</b> kết quả</h4>

                    @foreach ($news as $item)
                        <div class="news-group">
                            <a href="{{ route('news.detail', $item->slug) }}"
                                class="news-item d-flex align-items-start p-3 mb-3">
                                <div class="news-image flex-shrink-0">
                                    <img src="{{ asset($item->image) }}" alt="News Image" class="img-fluid rounded">
                                </div>
                                <div class="news-content pl-3">
                                    <h5 class="news-title font-weight-bold mb-1">{{ $item->title }}</h5>
                                    <div class="news-meta text-muted mb-2">
                                        <span class="news-author font-weight-bold">{{ $item->company_name }}</span> - <span
                                            class="news-date">{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                    </div>
                                    <p class="news-description mb-0">
                                        {{ strip_tags($item->content) }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-lg-3" style="color: #777;">
                @include('frontend.news.components.feature-sidebar')
            </div>
        </div>
    </div>
@endsection
