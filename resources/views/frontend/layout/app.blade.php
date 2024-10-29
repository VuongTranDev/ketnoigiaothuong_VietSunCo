<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ketnoigiaothuong.com</title>
    {{-- cdn css library --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- link css --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/styleLoading.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleFooter.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleNews.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/styleHomePage.css') }}">

    {{-- <link rel="stylesheet" href="../../css/style.css"> --}}

</head>

<body>
    @include('frontend.layout.header')

    <main style="margin-top: 85px;">
        @yield('renderBody')
    </main>

    @include('frontend.layout.footer')

    @include('frontend.component.loadingPage')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
