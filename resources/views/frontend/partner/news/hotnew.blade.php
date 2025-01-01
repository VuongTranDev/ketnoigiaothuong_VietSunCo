@extends('frontend.partner.layout.master')

@section('content')
    <div class="container-xl pt-4" style="padding-top: 5rem !important;">
        <div class="row">
            <div class="col-lg-9" style="color: #777;">

                @if (empty($news))
                    <h1>Không có bài viết nào</h1>
                @else
                    @foreach ($news as $item)
                        <div class="news-group">
                            <a href="{{ route('news.detail', $item->slug) }}"
                                class="news-item d-flex align-items-start p-3 mb-3">
                                <div class="news-image flex-shrink-0">
                                    <img src="{{ asset('frontend/image/media.jpg') }}" alt="News Image"
                                        class="img-fluid rounded">
                                </div>
                                <div class="news-content pl-3">
                                    <h5 class="news-title font-weight-bold mb-1">{{ $item->title }} (
                                        {{ $item->comments_count }} )</h5>
                                    <div class="news-meta text-muted mb-2">
                                        <span class="news-author font-weight-bold">{{ session('user')->email }}</span> -
                                        <span class="news-date">{{ date('d/m/Y', strtotime($item->updated_at)) }}</span>
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
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newsModalLabel">Chi tiết bài viết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-content">
                        <!-- Nội dung bài viết sẽ được tải ở đây -->
                        <p>Đang tải nội dung...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@endsection
