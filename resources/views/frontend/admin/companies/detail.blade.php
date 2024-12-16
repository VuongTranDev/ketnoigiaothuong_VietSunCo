@extends('frontend.admin.layout.master')
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>
                Company Details
            </h1>
        </div>
        <div class="company-details">
            <div class="image">
                <img alt="Company logo or building image" height="300"
                    src="https://storage.googleapis.com/a1aa/image/NtoJarYgmeXnNCM9DDY8CoH41qerxbYfsew5qPeOIO7fJGoeJA.jpg"
                    width="300" />
            </div>
            <div class="info">
                <h2>
                    {{ $company->company_name }}
                </h2>
                <p>
                    <strong>Categories:</strong>
                <ul>
                    @if(count($company->company_category) > 0)
                        @foreach ($company->company_category as $companyCategory)
                       <li> {{ $companyCategory->categories->name}}</li>
                        @endforeach
                    @else
                        <li>No categories found.</li>
                    @endif
                </ul>
                </p>
                <p>
                    <strong>
                        Founded:
                    </strong>
                    2005
                </p>
                <p>
                    <strong>
                        Employees:
                    </strong>
                    500
                </p>
                <p>
                    <strong>
                        Tax ID:
                    </strong>
                    123-45-6789
                </p>
                <p>
                    <strong>
                        Status:
                    </strong>
                    @if ($company->status == 1)
                    <strong> Hoạt động</strong>
                    @else
                    <strong> Ngưng hoạt động</strong>
                    @endif
                </p>
                <div class="address">
                    <h3>
                        Address
                    </h3>
                    @foreach ($company->addresses as $companyAddess)
                    <p>
                       {{ $companyAddess->address}}
                    </p>
                    @endforeach


                </div>
                <div class="contact">
                    <h3>
                        Contact Information
                    </h3>
                    <p>
                        <strong>
                            Email:
                        </strong>
                        info@company.com
                    </p>
                    <p>
                        <strong>
                            Phone:
                        </strong>
                        {{ $company->phone_number }}
                    </p>
                    <p>
                        <strong>
                            Website:
                        </strong>
                        <a href="{{$company->link}}">
                            {{$company->link}}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
