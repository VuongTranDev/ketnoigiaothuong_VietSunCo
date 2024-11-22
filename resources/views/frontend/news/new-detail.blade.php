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

                    <div class="container">
                        <form action="{{ route('postComment') }}" method="POST">
                            @csrf
                            <h2>Comments
                                ( {{ count($newComment->comments) }} )</h2>
                            <div class="new-comment">
                                <input type="text" name="user_id" hidden value=" {{ session('user')->id }}">
                                <input type="text" name="new_id" hidden value="{{ $news->id }}">
                                <textarea placeholder="Write your comment..." required rows="4" name="content"></textarea>
                                <button class="button">Post Comment</button>
                            </div>
                        </form>
                        <div class="comment-section">
                            @if (empty($newComment))
                                <span>
                                    Bài viết này chưa có lượt bình luận nào
                                </span>
                            @else
                                @foreach ($newComment->comments as $commentItem)
                                    @php
                                    @endphp
                                    <div class="comment" id="comment-{{ $commentItem->id }}">
                                        <img src="{{ $commentItem->user->email }}" alt="Profile picture of a user">
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <h4>{{ $commentItem->user->email }}</h4>
                                                <span>{{ date('d/m/Y', strtotime($commentItem->updated_at)) }}</span>
                                                <input type="text" hidden name="userComment_id"
                                                    value="{{ $commentItem->user_id }}">
                                            </div>
                                            <p id="comment-text-{{ $commentItem->id }}" class="comment-text">
                                                {{ $commentItem->content }}</p>
                                            <div class="comment-actions">
                                                <button>Like</button>
                                                @if ($commentItem->user_id == session('user')->id)
                                                    <button class="edit-comment"
                                                        data-comment-id="{{ $commentItem->id }}">Edit</button>
                                                        <button onclick="deleteComment({{$commentItem->id}})" class="delete-comment"
                                                    data-comment-id="{{ $commentItem->id }}">Delete</button>
                                                @endif


                                                <div id="edit-form-{{ $commentItem->id }}" class="edit-form"
                                                    style="display: none;">
                                                    <textarea id="edit-content-{{ $commentItem->id }}" name="edit_content" rows="4">{{ $commentItem->content }}</textarea>
                                                    <button onclick="saveEdit({{ $commentItem->id }})">Save</button>
                                                    <button onclick="cancelEdit({{ $commentItem->id }})">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
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
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f4f6;
            padding: 24px;
        }

        .container {
            margin: 0 auto;
            background-color: #ffffff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 16px;
        }

        textarea {
            width: 100%;
            padding: 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            resize: vertical;
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
        }

        .button {
            display: inline-block;
            margin-top: 8px;
            padding: 8px 16px;
            background-color: #3b82f6;
            color: #ffffff;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #2563eb;
        }

        .comment-section {
            margin-top: 24px;
        }

        .comment {
            display: flex;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .comment img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 16px;
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .comment-header h4 {
            font-size: 1rem;
            font-weight: bold;
        }

        .comment-header span {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .comment-text {
            margin-top: 4px;
            font-size: 1rem;
        }

        .comment-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 8px;
        }

        .comment-actions button {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 0.875rem;
            text-decoration: underline;
            transition: color 0.3s;
        }

        .comment-actions button:hover {
            color: #3b82f6;
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

@push('scripts')
    <script>
        document.querySelectorAll('.edit-comment').forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.getAttribute('data-comment-id');
                console.log(commentId);

                document.getElementById('comment-text-' + commentId).style.display =
                    'none'; // Ẩn nội dung cũ
                document.getElementById('edit-form-' + commentId).style.display =
                    'block'; // Hiện form chỉnh sửa
            });
        });



        function saveEdit(commentId) {
            const newContent = document.getElementById('edit-content-' + commentId).value;
            $.ajax({
                url: '/api/comments/' + commentId,
                type: 'PUT',
                data: {
                    _toke: '{{ csrf_token() }}',
                    edit_content: newContent,
                },
                success: function(response) {
                    if (response.status === "success") {
                        document.getElementById('comment-text-' + commentId).innerText = newContent;
                        toastr.success(response.message);
                        document.getElementById('comment-text-' + commentId).style.display = 'block';
                        document.getElementById('edit-form-' + commentId).style.display = 'none';
                    } else {
                        console.error('Error' + response.error);
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
        // Hàm để hủy chỉnh sửa (ẩn form)
        function cancelEdit(commentId) {
            document.getElementById('comment-text-' + commentId).style.display = 'block'; // Hiện lại nội dung cũ
            document.getElementById('edit-form-' + commentId).style.display = 'none'; // Ẩn form chỉnh sửa
        }

        function deleteComment(commentId)
        {
            $.ajax({
                url :'/api/comments/' + commentId,
                type: 'DELETE',
                data: {
                    _toke: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                        document.getElementById('comment-' + commentId).remove();
                    }
                    else {
                        console.error('Error' + response.error);
                    }
                },  
                error: function(xhr) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    </script>
@endpush
