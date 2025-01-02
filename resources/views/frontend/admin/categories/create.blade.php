@extends('frontend.admin.layout.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Categories</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add category</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name category</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>

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
