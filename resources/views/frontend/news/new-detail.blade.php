@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9">
                <div class="wsus__main_blog">
                    <div class="wsus__main_blog_img mb-3">
                        <img src="{{ asset('frontend/image/DaNang.png') }}" alt="blog" class="img-fluid w-100">
                    </div>

                    <h2>{{ $news->title }}</h2>
                    <div class="wsus__main_blog_header">
                        <span><i class="fas fa-user-tie"></i> by VietSunCo</span>
                        <span><i class="fas fa-calendar-alt"></i> 03/10/2024</span>
                    </div>

                    <div class="wsus__description_area">
                        <p>
                            {!! $news->content !!}
                        </p>
                    </div>
                    <div class="wsus__share_blog">
                        <label>share:</label>
                        <ul>
                            <li>
                                <a class="facebook" href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>

                            <li>
                                <a class="twitter" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>

                            <li>
                                <a class="linkedin" href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="comment-box">
                        <h4 class="mb-4" style="font-weight: 700;">Bình luận</h4>

                        <div class="comment-group">
                            <img class="user-avatar" src="{{ asset('frontend/image/icon.png') }}" alt="">
                            <textarea class="content-comment" placeholder="Để lại bình luận của bạn"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="send-comment">Gửi bình luận</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                @include('frontend.news.components.feature-sidebar')
            </div>
        </div>
    </div>

    <style>
        .comment-box {
            width: 100%;
            border: none;
            background-color: #FAFAFC;
            padding: 20px;
        }

        .comment-group {
            display: flex;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e6e6e6;
            float: left;
            margin-right: 10px;
        }

        .content-comment {
            width: 100%;
            height: 150px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .content-comment::placeholder {
            color: #777;
            font-size: 14px;
        }

        .send-comment {
            background-color: #3EAEF4;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
        }
    </style>
@endsection
