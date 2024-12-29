@extends('frontend.partner.layout.master')


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thông tin công ty</h4>
                                <a href="{{ route('partner.company.category') }}" style="margin-right:10px">  <button type="" class="btn btn-primary">Cập nhật lĩnh vực</button> </a>
                                <a href="{{ route('partner.company.images') }}"> <button type="" class="btn btn-primary">Cập nhật các hình ảnh</button> </a>


                        </div>

                        <div class="card-body">
                            <form action="{{ route('updateCompanyFromView') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Hình ảnh công ty</label>
                                    <input type="file" class="form-control" name="image">
                                    <img src="{{ asset($company->image) }}" width="100" alt="Current Image">
                                </div>
                                <div class="form-group" style="display:none">
                                    <label>Id</label>
                                    <input type="text" class="form-control" name="id" value="{{ old('id', $company->id) }}">
                                </div>

                                <div class="form-group">
                                    <label>Tên công ty</label>
                                    <input type="text" class="form-control" name="company_name" value="{{ old('company_name', $company->company_name) }}">
                                </div>
                                <div class="form-group" style="display:none">
                                    <label>Slug</label>
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug', $company->slug) }}">
                                </div>
                                <div class="form-group">
                                    <label>Tên người đại diện</label>
                                    <input type="text" class="form-control" name="representative" value="{{ old('representative', $company->representative) }}">
                                </div>
                                <div class="form-group">
                                    <label>Tên viết tắt của công ty</label>
                                    <input type="text" class="form-control" name="short_name" value="{{ old('short_name', $company->short_name) }}">
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $company->phone_number) }}">
                                </div>
                                <div class="form-group">
                                    <label>Email công ty</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $company->email) }}">
                                </div>
                                <div class="form-group">
                                    <label>Mã số thuế</label>
                                    <input type="text" class="form-control" name="tax_code" value="{{ old('tax_code', $company->tax_code) }}">
                                </div>
                                <div class="form-group">
                                    <label>Link công ty</label>
                                    <input type="text" class="form-control" name="link" value="{{ old('link', $company->link) }}">
                                </div>
                                <div class="form-group">
                                    <label>Thông tin công ty</label>
                                    <input type="text" class="form-control" name="content" value="{{ old('content', $company->content) }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
