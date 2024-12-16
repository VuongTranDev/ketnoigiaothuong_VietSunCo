{{-- start loading page --}}
<div class="loading">
    <div class="loader" id="loader">
        {{-- <div class="box">
            <div class="logo">
                <img src="{{ asset('frontend/image/logo.png') }}" alt="Công ty TNHH Thương Mại Dịch Vụ VietSunCo"
                    width="100">
            </div>
        </div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div> --}}
    </div>
</div>

<script>
    window.addEventListener("load", function() {
        const loading = document.querySelector('.loading');
        loading.style.display = 'none';
    });

    window.addEventListener("pageshow", function(event) {
        const loading = document.querySelector('.loading');
        if (event.persisted) {
            loading.style.display = 'none';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('a');
        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                const href = link.getAttribute('href');

                if (link.target === '_blank' || href === '#' || href === '' || href.startsWith(
                        'javascript:')) {
                    return;
                }

                const loading = document.querySelector('.loading');
                loading.style.display = 'block';
            });
        });

        const buttons = document.querySelectorAll('button');
        buttons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (button.type === 'button' && !button.hasAttribute('data-submit') && !button
                    .hasAttribute('data-ajax')) {
                    return;
                }

                const loading = document.querySelector('.loading');
                loading.style.display = 'block';
            });
        });

        $(document).ajaxStart(function() {
            $('.loading').show();
        }).ajaxStop(function() {
            $('.loading').hide();
        });
    });
</script>



{{-- end laoding page --}}
