@php
    $footerGridOnes = Cache::rememberForever('footer_grid_one', function () {
        return \App\Models\FooterGridOne::first();
    });
    $footerSocials = Cache::rememberForever('footer_socials', function () {
        return \App\Models\FooterSocial::where('status', 1)->get();
    });
    $footerGridTwoLinks = Cache::rememberForever('footer_grid_two', function () {
        return \App\Models\FooterGridTwo::where('status', 1)->get();
    });
    $footerTitle = \App\Models\FooterTitle::first();
    $footerGridThreeLinks = Cache::rememberForever('footer_grid_three', function () {
        return \App\Models\FooterGridThree::where('status', 1)->get();
    });
@endphp

@include('frontend.layout.component.form-send-contact')

<footer class="footer_2">
    <div class="container-xl">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="{{ url('/') }}">
                        <img src="{{ asset(@$footerGridOnes->logo) }}" alt="logo">
                    </a>
                    <a class="action" href="tel:{{ @$footerGridOnes->phone }}"><i
                            class="fas fa-phone-alt me-2"></i>{{ @$footerGridOnes->phone }}</a>
                    <a class="action" href="mailto:{{ @$footerGridOnes->email }}"><i
                            class="far fa-envelope me-2"></i>{{ @$footerGridOnes->email }}</a>
                    <a class="action" href="https://www.google.com/maps/search/{{ urlencode(@$footerGridOnes->address) }}" target="_blank"><i class="fa-solid fa-location-dot me-2"></i>{{ @$footerGridOnes->address }}</a>
                    <ul class="wsus__footer_social">
                        @foreach ($footerSocials as $link)
                            <li><a class="behance" href="{{ $link->url }}"><i class="{{ $link->icon }}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{ @$footerTitle->footer_grid_two_title }}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach (@$footerGridTwoLinks as $link)
                            <li><a href="{{ $link->url }}"><i class="fas fa-caret-right"></i>
                                    {{ $link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{ $footerTitle->footer_grid_three_title }}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footerGridThreeLinks as $link)
                            <li><a href="{{ $link->url }}"><i class="fas fa-caret-right"></i>
                                    {{ $link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="wsus__footer_content wsus__footer_content_2">
                    <h3>Subscribe To Our Newsletter</h3>
                    <p>Get all the latest information on Events, Sales and Offers.
                        Get all the latest information on Events.</p>
                    <form action="" method="POST" id="newsletter" class="d-flex">
                        @csrf
                        <input type="text" placeholder="Email" name="email" class="newsletter_email">
                        <button type="submit" class="common_btn subscribe_btn">subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        <div class="container-xl">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        <p>{{ @$footerGridOnes->copyright }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
