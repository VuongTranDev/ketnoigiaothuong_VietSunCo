@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('news') }}">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ @$news->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9">
                <div class="wsus__main_blog">
                    <div class="wsus__main_blog_img mb-3">
                        <img src="{{ asset($news->image) }}" alt="blog" class="img-fluid w-100">
                    </div>

                    <h2>{{ $news->title }}</h2>
                    <div class="wsus__main_blog_header">
                        <span><i class="fas fa-user-tie"></i> by {{ $news->company_name }}</span>
                        <span><i class="fas fa-calendar-alt"></i> {{ date('d/m/Y', strtotime($news->created_at)) }}</span>
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
                            <h4 class="count-comment">Bình luận ( {{ count($newComment->comments) }} )</h4>
                            <div class="new-comment">
                                @if (session('user') && session('user')->id)
                                    <input type="text" name="user_id" hidden value="{{ session('user')->id }}">
                                @endif
                                <input type="text" name="new_id" hidden value="{{ $news->id }}">
                                <textarea class="textarea-comment" placeholder="Nhập nội dung bình luận ..." required rows="4" name="content"></textarea>
                                <button class="btn post-comment mt-2">Gửi bình luận</button>
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

                                                @if ( session('user')->id  && $commentItem->user->id === session('user')->id )
                                                <h4>Bạn </h4>
                                                @else
                                                    <h4>{{ optional($commentItem->user->company)->company_name ?? $commentItem->user->email }}
                                                    </h4>
                                                @endif

                                                <span>{{ date('d/m/Y', strtotime($commentItem->updated_at)) }}</span>
                                                <input type="text" hidden name="userComment_id"
                                                    value="{{ $commentItem->user_id }}">
                                            </div>
                                            <p id="comment-text-{{ $commentItem->id }}" class="comment-text">
                                                {{ $commentItem->content }}</p>
                                            <div class="comment-actions">
                                                @if ($commentItem->user_id == session('user')->id)
                                                    <button class="edit-comment"
                                                        data-comment-id="{{ $commentItem->id }}">Edit</button>
                                                    <button onclick="deleteComment({{ $commentItem->id }})"
                                                        class="delete-comment"
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

        function deleteComment(commentId) {
            $.ajax({
                url: '/api/comments/' + commentId,
                type: 'DELETE',
                data: {
                    _toke: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                        document.getElementById('comment-' + commentId).remove();
                    } else {
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
