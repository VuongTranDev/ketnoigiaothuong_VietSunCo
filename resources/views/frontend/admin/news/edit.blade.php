@extends('frontend.admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tin tức</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa tin tức</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.news.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.news.update', $new->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $new->id }}" name="id">
                                <input type="hidden" name="user_id" value="{{ session('user')->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tiêu đề</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $new->title }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tag</label>
                                            <input type="text" class="form-control" name="tag_name"
                                                value="{{ $new->tag_name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ảnh đại diện</label>
                                            <input type="file" class="form-control" name="image">
                                            <img src="{{ asset($new->image) }}" alt="" width="100">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Loại tin tức</label>
                                            <select class="form-control" name="cate_id">
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $new->categorie->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nội dung tin tức</label>
                                    <textarea class="form-control summernote" name="content">{{ $new->content }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="status" required>
                                                <option {{ $new->status === 1 ? 'selected' : '' }} value="1">Hiển thị</option>
                                                <option {{ $new->status === 0 ? 'selected' : '' }} value="0">Ẩn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
