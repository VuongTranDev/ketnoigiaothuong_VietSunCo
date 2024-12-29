@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl d-flex justify-content-center pt-5 pb-5">
        <div class="login-container">
            <h2 class="title-login">Đăng nhập</h2>
            <form action="{{ route('auth.post-login') }}" method="POST">
                @csrf
                <div class="login-group">
                    <label class="title-inp" for="username">Username or Email</label>
                    <div class="wrapper">
                        <div class="inp-group">
                            <i class="fas fa-user"></i>
                            <input type="text" name="email" class="inp-login " placeholder="Nhập email của bạn"  required/>
                        </div>

                    </div>
                </div>
                <div class="login-group">
                    <label class="title-inp" for="password">Password</label>
                    <div class="wrapper">
                        <div class="inp-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" class="inp-login" placeholder="Nhập mật khẩu của bạn" required />
                        </div>
                    </div>
                </div>
                <button type="submit" class="login-button">Đăng nhập</button>
                <div class="links">
                    <a href="#">Quên mật khẩu?</a>
                    <a href="{{ route('get.register') }}">Đăng ký</a>
                </div>
                <div class="divider">
                    <span>Đăng nhập bằng</span>
                </div>
                <div class="google-login">

                    <a href="{{ route('google.login') }}">
                        <img src="{{ asset('frontend/image/ic-google.png') }}" alt="Google Logo">
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            (function(window, document) {
                'use strict';

                var inputs = document.querySelectorAll('.inp-login');

                inputs.forEach(function(input) {
                    input.addEventListener('focus', function() {
                        this.parentNode.classList.add('is-focused');
                    });

                    input.addEventListener('blur', function() {
                        this.parentNode.classList.remove('is-focused');
                    });
                });

            })(window, document);
        </script>
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



            });
        </script>
    @endpush
@endsection
