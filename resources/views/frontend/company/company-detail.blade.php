@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ @$company->company_name }}</li>
            </ol>
        </nav>

        <div class="img-company-detail pt-5 pb-5 d-flex justify-content-center w-100">
            <img src="{{ asset('frontend/image/logo.png') }}" alt="Công ty ..." width="600px">
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div>
                    <h2 class="title-b2b">Giới thiệu</h2>
                    <hr class="line-title">
                </div>
                <p style="text-align: justify">{{ @$company->content }}
                </p>

                <div>
                    <h2 class="title-b2b">Thông tin chung</h2>
                    <hr class="line-title">
                </div>
                <div class="company-info">
                    <table class="info-table">
                        <tr>
                            <td><strong>Tên công ty:</strong></td>
                            <td>{{ @$company->company_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tên viết tắt:</strong></td>
                            <td>{{ @$company->short_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Người đại diện:</strong></td>
                            <td>{{ @$company->representative }}</td>
                        </tr>
                        <tr>
                            <td><strong>Lĩnh vực:</strong></td>
                            <td>
                                @foreach ($categories as $category)
                                    {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                        </tr>
                        {{-- <tr>
                            <td><strong>Khu vực:</strong></td>
                            <td>Miền nam</td>
                        </tr> --}}
                    </table>
                </div>
                <hr class="line-w-100">
                <div class="mt-4">
                    <h2 class="title-b2b">Đánh giá và nhận xét</h2>
                    <hr class="line-title">
                </div>
                <div class="review-section">
                    <div class="rating-summary">
                        <div class="average-rating">
                            <span class="rating-score">5.0/5</span>
                            <div class="stars">
                                ★★★★★
                            </div>
                            <span class="total-reviews">100 đánh giá</span>
                        </div>
                        <div class="detailed-ratings">
                            <p>5 <label class="stars">★</label> (100 đánh giá)</p>
                            <p>4 <label class="stars">★</label> (0 đánh giá)</p>
                            <p>3 <label class="stars">★</label> (0 đánh giá)</p>
                            <p>2 <label class="stars">★</label> (0 đánh giá)</p>
                            <p>1 <label class="stars">★</label> (0 đánh giá)</p>
                        </div>
                    </div>

                    <div class="reviews-list">
                        <div class="rating-item">
                            <div class="rating-details">
                                <div>
                                    <img src="{{ asset('frontend/image/icon.png') }}" alt="User Avatar" class="user-avatar">
                                    <span class="user-name">Công ty...</span>
                                </div>

                                <div class="stars">★★★★★</div>
                                <p class="review-text">Rất chuyên nghiệp,...</p>
                            </div>
                            <div class="more-options">⋮</div>
                        </div>
                        <div class="rating-item">
                            <div class="rating-details">
                                <div>
                                    <img src="{{ asset('frontend/image/icon.png') }}" alt="User Avatar" class="user-avatar">
                                    <span class="user-name">Công ty...</span>
                                </div>
                                <div class="stars">★★★★★</div>
                                <p class="review-text">Rất chuyên nghiệp,...</p>
                            </div>
                            <div class="more-options">⋮</div>
                        </div>
                    </div>

                    <div class="review-actions">
                        <button class="view-more-btn me-3">Xem thêm đánh giá</button>
                        <button class="write-review-btn">Viết đánh giá</button>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <h3 class="company-name-detail">{{ @$company->company_name }}</h3>
                    <div class="info">
                        <p><i class="fas fa-envelope"></i> hi@vietsunco.com</p>
                        <p><i class="fa-solid fa-globe"></i> <a href="{{ $company->link }}">{{ @$company->link }}</a></p>
                        <p><i class="fas fa-phone-alt"></i> {{ @$company->phone_number }}</p>
                        <p><i class="fas fa-map-marker-alt"></i> {{ @$address->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 w-100 d-flex flex-column align-items-center">
            <h2 class="title-b2b">Các công ty cùng lĩnh vực</h2>
            <hr class="line-title ">
        </div>

        {{-- @include('frontend.company.components.company-same-field') --}}

    </div>

    <style>
        .line-w-100 {
            background-color: #0d6fac;
            height: 2px;
            padding-left: 8px;
            border: none;
        }

        .company-info {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 0;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 150px;
            color: #333;
            font-weight: bold;
        }

        .review-section {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .average-rating {
            padding-right: 40px;
            padding-left: 30px;
            text-align: center;
        }

        .detailed-ratings {
            padding-left: 40px;
            border-left: 1px solid #3EAEF4;
            margin-top: 20px;
        }

        .rating-score {
            font-size: 24px;
            font-weight: bold;
        }

        .stars {
            color: #ffd700;
            font-size: 18px;
            margin: 5px 0;
        }

        .total-reviews {
            font-weight: bold;
            color: #333;
        }

        .detailed-ratings p {
            margin: 2px 0;
            font-size: 15px;
        }

        .reviews-list {
            margin-bottom: 20px;
        }

        .rating-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-top: 1px solid #e0e0e0;
        }

        .user-name {
            font-weight: bold;
            margin-right: 10px;
        }

        .review-text {
            margin: 0;
            color: #555;
            font-size: 14px;
        }

        .more-options {
            font-size: 20px;
            color: #555;
            cursor: pointer;
        }

        .review-actions {
            display: flex;
        }

        .view-more-btn,
        .write-review-btn {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .view-more-btn {
            color: #3EAEF4;
            background-color: #fff;
            border: 1px solid #3EAEF4;
        }

        .write-review-btn {
            color: #fff;
            background-color: #3EAEF4;
        }

        .view-more-btn:hover {
            background-color: #3EAEF4;
            color: #fff;
        }

        .write-review-btn:hover {
            background-color: #1192e2;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .rating-details {
            flex-grow: 1;
        }

        /*  */

        .card {
            background-color: #f9f9f9;
            box-shadow: 0 4px 10px rgb(214, 214, 214);
            padding: 20px;
            border-radius: 5px;
            line-height: 2;
            position: sticky;
            top: 130px;
            border: none;
        }

        .company-name-detail {
            margin-bottom: 20px;
            text-align: center;
        }

        .info p {
            margin-bottom: 10px;
        }

        .info i {
            margin-right: 5px;
            color: #3EAEF4;
        }
    </style>
@endsection
