@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pt-2 pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Name news</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9">
                <div class="wsus__main_blog">
                    <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit...</h2>
                    <div class="wsus__main_blog_header">
                        <span><i class="fas fa-user-tie"></i> by VietSunCo</span>
                        <span><i class="fas fa-calendar-alt"></i> 03/10/2024</span>
                    </div>
                    <div class="wsus__main_blog_img mt-3 mb-3">
                        <img src="{{ asset('frontend/image/DaNang.png') }}" alt="blog" class="img-fluid w-100">
                    </div>

                    <div class="wsus__description_area">
                        <p style="text-align: justify; line-height: 30px">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce
                            posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna
                            eros
                            quis urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus. Pellentesque habitant morbi
                            tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede.
                            Mauris et orci. Aenean nec lorem.
                            In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate
                            vitae,
                            pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy. Fusce aliquet
                            pede
                            non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla. Donec blandit feugiat
                            ligula.
                            Donec hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl
                            eget
                            sapien.
                            Donec ut est in lectus consequat consequat. Etiam eget dui. Aliquam erat volutpat. Sed at lorem
                            in
                            nunc porta tristique. Proin nec augue. Quisque aliquam tempor magna. Pellentesque habitant morbi
                            tristique senectus et netus et malesuada fames ac turpis egestas. Nunc ac magna. Maecenas odio
                            dolor, vulputate vel, auctor ac, accumsan id, felis. Pellentesque cursus sagittis felis.
                            Pellentesque porttitor, velit lacinia egestas auctor, diam eros tempus arcu, nec vulputate augue
                            magna vel risus. Cras non magna vel ante adipiscing rhoncus. Vivamus a mi. Morbi neque. Aliquam
                            erat
                            volutpat. Integer ultrices lobortis eros. Pellentesque habitant morbi tristique senectus et
                            netus et
                            malesuada fames ac turpis egestas. Proin semper, ante vitae sollicitudin posuere, metus quam
                            iaculis
                            nibh, vitae scelerisque nunc massa eget pede. Sed velit urna, interdum vel, ultricies vel,
                            faucibus
                            at, quam. Donec elit est, consectetuer eget, consequat quis, tempus quis, wisi.
                            In in nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                            hymenaeos. Donec ullamcorper fringilla eros. Fusce in sapien eu purus dapibus commodo. Cum
                            sociis
                            natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras faucibus
                            condimentum
                            odio. Sed ac ligula. Aliquam at eros. Etiam at ligula et tellus ullamcorper ultrices. In
                            fermentum,
                            lorem non cursus porttitor, diam urna accumsan lacus, sed interdum wisi nibh nec nisl.
                            Ut tincidunt volutpat urna. Mauris eleifend nulla eget mauris. Sed cursus quam id felis.
                            Curabitur
                            posuere quam vel nibh. Cras dapibus dapibus nisl. Vestibulum quis dolor a felis congue vehicula.
                            Maecenas pede purus, tristique ac, tempus eget, egestas quis, mauris. Curabitur non eros. Nullam
                            hendrerit bibendum justo. Fusce iaculis, est quis lacinia pretium, pede metus molestie lacus, at
                            gravida wisi ante at libero.
                        </p>
                        <img src="{{ asset('frontend/image/DaNang.png') }}" alt="blog" class="img-fluid w-100">
                        <p style="text-align: justify; line-height: 30px">
                            Quisque ornare placerat risus. Ut molestie magna at mi. Integer aliquet mauris et nibh. Ut
                            mattis
                            ligula posuere velit. Nunc sagittis. Curabitur varius fringilla nisl. Duis pretium mi euismod
                            erat.
                            Maecenas id augue. Nam vulputate. Duis a quam non neque lobortis malesuada.
                            Praesent euismod. Donec nulla augue, venenatis scelerisque, dapibus a, consequat at, leo.
                            Pellentesque libero lectus, tristique ac, consectetuer sit amet, imperdiet ut, justo. Sed
                            aliquam
                            odio vitae tortor. Proin hendrerit tempus arcu. In hac habitasse platea dictumst. Suspendisse
                            potenti. Vivamus vitae massa adipiscing est lacinia sodales. Donec metus massa, mollis vel,
                            tempus
                            placerat, vestibulum condimentum, ligula. Nunc lacus metus, posuere eget, lacinia eu, varius
                            quis,
                            libero.
                            Aliquam nonummy adipiscing augue. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Maecenas
                            porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada
                            libero,
                            sit amet commodo magna eros quis urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                            Proin
                            pharetra nonummy pede. Mauris et orci.
                            Aenean nec lorem. In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque
                            at,
                            vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
                            Fusce aliquet pede non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla. Donec
                            blandit feugiat ligula.

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
                            <textarea class="content-comment"  placeholder="Để lại bình luận của bạn"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="send-comment">Gửi bình luận</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="wsus__blog_sidebar" id="sticky_sidebar">
                    <div class="wsus__blog_search">
                        <h4>Tìm kiếm</h4>
                        <form action="" method="GET">
                            <input type="text" placeholder="Tìm kiếm..." name="search">
                            <button type="submit" class="common_btn"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="wsus__blog_post">
                        <h4>Các bài blog khác</h4>
                        @for ($i = 0; $i < 4; $i++)
                            <div class="wsus__blog_post_single">
                                <a href="#" class="wsus__blog_post_img">
                                    <img style="height: 71px;" src="{{ asset('frontend/image/DaNang.png') }}" alt="blog"
                                        class="imgofluid w-100">
                                </a>
                                <div class="wsus__blog_post_text">
                                    <a href="#">blog</a>
                                    <p> <span>03/10/2024</span></p>
                                    {{-- {{ date('d/m/Y', strtotime($blog->created_at)) }} --}}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
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
