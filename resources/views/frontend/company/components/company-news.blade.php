<section class="news-one">
    <div class="container-xl">
        <div class="news-one__bottom">
            <div class="row">
                @foreach ($news as $item)
                    <div class="col-xl-3 col-lg-3 wow fadeInUp animated" data-wow-delay="100ms"
                        style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                        <div class="news-one__single news__single">
                            <div class="news__img">
                                <a href="{{ route('news.detail', $item->slug) }}">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                </a>
                            </div>
                            <div class="news__content">
                                <ul class="list-unstyled news-one__meta">
                                    <li><a href="news-details.html"><i class="fas fa-calendar-alt"></i>
                                            {{ date('d/m/Y', strtotime($item->created_at)) }}</a></li>
                                </ul>
                                <h3 class="news__title">
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
