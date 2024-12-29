{{-- <section class="news-one">
    <div class="container-xl">
        <div class="news-one__top">
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <div class="news-one__top-left">
                        <div class="section-title text-left">
                            <span class="section-title__tagline">From the blog post</span>
                            <h2 class="section-title__title">Tin tức &amp; bài viết</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 d-flex justify-content-end align-items-center">
                    <div class="news-one__top-right">
                        <a href="{{ route('blog.blog-all') }}" class="news-one__btn thm-btn">Xem tất cả</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="news-one__bottom">
            <div class="row">
                @foreach ($blogs as $item)
                    <div class="col-xl-4 col-lg-4 wow fadeInUp animated" data-wow-delay="100ms"
                        style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                        <div class="news-one__single">
                            <div class="news-one__img">
                                <img src="{{ asset($item->hinhanh) }}" alt="{{$item->tieude}}">
                                <a href="{{ route('blog.detail', $item->slug) }}">
                                    <span class="news-one__plus"></span>
                                </a>
                                <div class="news-one__date">
                                    <p>{{ date('d M', strtotime($item->created_at)) }}</p>
                                </div>
                            </div>
                            <div class="news-one__content">
                                <ul class="list-unstyled news-one__meta">
                                    <li><a href="news-details.html"><i class="far fa-user-circle"></i>{{ $item->nhanvien->hoten }}</a></li>
                                    <li><a href="news-details.html"><i class="fas fa-calendar-alt"></i>{{ date('d/m/Y', strtotime($item->created_at)) }}</a>
                                    </li>
                                </ul>
                                <h3 class="news-one__title">
                                    <a href="{{ route('blog.detail', $item->slug) }}">{{ $item->tieude }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section> --}}

<section class="news-one">
    <div class="container-xl">
        <div class="news-one__top">
            <div class="row p-4">
                <div class="col-xl-9 col-lg-9">
                    <div class="news-one__top-left">
                        <div class="section-title text-left">
                            <h2 class="section-title__title title-b2b">Tin tức &amp; bài viết</h2>
                            <hr class="line-title">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 d-flex justify-content-end align-items-center">
                    <div class="news-one__top-right">
                        <a href="{{ route('news') }}" class="news-one__btn thm-btn">Xem tất cả</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="news-one__bottom">
            <div class="row">
                @foreach ($news as $item)
                    <div class="col-xl-4 col-lg-4 wow fadeInUp animated" data-wow-delay="100ms"
                        style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                        <div class="news-one__single">
                            <div class="news-one__img">
                                <a href="{{ route('news.detail', $item->slug) }}">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                    <span class="news-one__plus"></span>
                                </a>
                                {{-- <div class="news-one__date">
                                    <p>{{ date('d M', strtotime($item->created_at)) }}</p>
                                </div> --}}
                            </div>
                            <div class="news-one__content">
                                <ul class="list-unstyled news-one__meta">
                                    {{-- <li><a href="news-details.html"><i class="far fa-user-circle"></i> $item->nhanvien->hoten</a></li> --}}
                                    <li><a href="news-details.html"><i class="fas fa-calendar-alt"></i> {{ date('d/m/Y', strtotime($item->created_at)) }}</a></li>
                                </ul>
                                <h3 class="news-one__title">
                                    <a href="">{{ $item->title }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
