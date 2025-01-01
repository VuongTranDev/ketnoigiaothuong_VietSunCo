@extends('frontend.admin.layout.master')
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>
                Thông tin công ty
            </h1>
        </div>
        <div class="company-details card">
            <div class="image">
                <img alt="Company logo or building image" height="300" src="{{ asset($company->image) }}" />
            </div>
            <div class="info">
                <h2>
                    {{ $company->company_name }}
                </h2>
                <p>
                    <strong>
                        Tên viết tắt:
                    </strong>
                    {{ $company->short_name }}
                </p>
                <p>
                    <strong>
                        Tên người đại diện:
                    </strong>
                    {{ $company->representative }}
                <p>
                    <strong>Lĩnh vực:</strong>
                <ul>
                    @if (count($company->company_category) > 0)
                        @foreach ($company->company_category as $companyCategory)
                            <li> {{ $companyCategory->categories->name }}</li>
                        @endforeach
                    @else
                        <li>Đang cập nhật.</li>
                    @endif
                </ul>
                </p>

                <p>
                    <strong>
                        Mã số thuế:
                    </strong>
                    {{ $company->tax_code }}
                </p>
                <p>
                    <strong>
                        Tình trạng:
                    </strong>
                    @if ($company->status == 1)
                        <strong> Hoạt động</strong>
                    @else
                        <strong> Ngưng hoạt động</strong>
                    @endif
                </p>
                <div class="address">
                    <h3>
                        Địa chỉ
                    </h3>
                    @foreach ($company->addresses as $companyAddess)
                        <p>
                            {{ $companyAddess->address }}
                        </p>
                    @endforeach


                </div>
                <div class="contact">
                    <h3>
                        Thông tin liên hệ
                    </h3>
                    <p>
                        <strong>
                            Email:
                        </strong>
                        info@company.com
                    </p>
                    <p>
                        <strong>
                            Số điện thoại:
                        </strong>
                        {{ $company->phone_number }}
                    </p>
                    <p>
                        <strong>
                            Website:
                        </strong>
                        <a href="{{ $company->link }}">
                            {{ $company->link }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
