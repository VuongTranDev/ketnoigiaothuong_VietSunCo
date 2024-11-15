@extends('frontend.partner.layout.master')

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
                        <h4>Thêm tin tức mới</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tag</label>
                                        <input type="text" class="form-control" name="tag_name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="summernote" class="form-control summernote" name="content">{{ old('content') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Tạo mới</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection
