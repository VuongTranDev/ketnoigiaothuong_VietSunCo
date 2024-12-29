@extends('frontend.partner.layout.master')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hình ảnh sản phẩm</h1>
        </div>
        <div class="mb-3">
            <a href="{{ route('partner.company.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách các ảnh</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('partner.company.createImages') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Thêm ảnh <code>(Multiple image supported!)</code></label>
                                    <input type="file" name="image[]" class="form-control" multiple>

                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Images</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
