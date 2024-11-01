@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl d-flex justify-content-center pt-5 pb-5">
        <div class="login-container">
            <h2 class="title-login">Đăng ký</h2>
            <form>
                <div class="login-group">
                    <label class="title-inp" for="username">Username or Email</label>
                    <div class="wrapper">
                        <div class="inp-group">
                            <i class="fas fa-user"></i>
                            <input type="text" id="username" class="inp-login"
                                placeholder="Nhập username hoặc email của bạn" />
                        </div>
                    </div>
                </div>
                <div class="login-group">
                    <label class="title-inp" for="password">Password</label>
                    <div class="wrapper">
                        <div class="inp-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="text" id="password" class="inp-login" placeholder="Nhập mật khẩu của bạn" />
                        </div>
                    </div>
                </div>
                <div class="login-group">
                    <label class="title-inp" for="confirm-password">Confirm Password</label>
                    <div class="wrapper">
                        <div class="inp-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="text" id="confirm-password" class="inp-login" placeholder="Xác nhận mật khẩu của bạn" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="login-button">Đăng ký</button>
                <div class="links d-flex justify-content-end">
                    <a href="{{ route('auth.login') }}">Quay lại trang đăng nhập</a>
                </div>
                <div class="divider">
                    <span>Đăng nhập bằng</span>
                </div>
                <div class="google-login">
                    <img src="{{ asset('frontend/image/ic-google.png') }}" alt="Google Logo">
                </div>
            </form>
        </div>
    </div>

    @push('script')
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
    @endpush
@endsection
