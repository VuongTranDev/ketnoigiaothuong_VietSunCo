{{-- start loading page --}}
<div class="loading">
    <div class="loader" id="loader">
        <div class="box">
            <div class="logo">
                <img src="{{ asset('frontend/image/logo.png') }}" alt="Công ty TNHH Thương Mại Dịch Vụ VietSunCo"
                    width="50">
            </div>
        </div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
    </div>
</div>

<script>
    window.addEventListener("load", function() {
        const loading = document.querySelector('.loading');
        loading.style.display = 'none';
    });

    // window.addEventListener("load", function() {
    //     // Hiển thị loading trong 5 giây
    //     setTimeout(function() {
    //         const loading = document.querySelector('.loading');
    //         loading.style.display = 'none';
    //     }, 1000); // 5000 ms = 5 giây
    // });
</script>

{{-- end laoding page --}}
