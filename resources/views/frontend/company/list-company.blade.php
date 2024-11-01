@extends('frontend.layout.app')

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pt-2 pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách công ty</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-3">
                <div class="filter-container mt-3">
                    <div class="sort-dropdown">
                        <div class="dropdown">
                            <label
                                class="btn btn-secondary btn-dropdown justify-content-between d-flex justify-between align-items-center"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mặc định
                                <i class="fas fa-chevron-down ms-2"></i>
                            </label>
                            <ul class="dropdown-menu w-100">
                                <li><a class="dropdown-item" href="#">Mặc định</a></li>
                                <li><a class="dropdown-item" href="#">Theo thứ tự A-Z</a></li>
                                <li><a class="dropdown-item" href="#">Theo thứ tự Z-A</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Bộ lọc tìm kiếm</h3>
                        <button class="clear-filter">Bỏ chọn tất cả ✕</button>
                        <hr class="line">
                    </div>

                    <div class="rating-section mb-3">
                        <label class="btn w-100 btn-dropdown text-start" type="button" data-bs-toggle="collapse"
                            data-bs-target="#ratingCollapse" aria-expanded="false" aria-controls="ratingCollapse">
                            Theo đánh giá
                            <i class="fas fa-chevron-down ms-2"></i>
                        </label>
                        <div class="collapse show" id="ratingCollapse">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rating" id="rating5" value="5">
                                <label class="form-check-label" for="rating5"><span>★★★★★</span></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rating" id="rating4" value="4">
                                <label class="form-check-label" for="rating4"><span>★★★★☆</span></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rating" id="rating3" value="3">
                                <label class="form-check-label" for="rating3"><span>★★★☆☆</span></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rating" id="rating2" value="2">
                                <label class="form-check-label" for="rating2"><span>★★☆☆☆</span></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rating" id="rating1" value="1">
                                <label class="form-check-label" for="rating1"><span>★☆☆☆☆</span></label>
                            </div>
                        </div>

                        <hr class="line">
                    </div>

                    <div class="verification-section mb-3">
                        <button class="btn w-100 btn-dropdown text-start" type="button" data-bs-toggle="collapse"
                            data-bs-target="#verificationCollapse" aria-expanded="false"
                            aria-controls="verificationCollapse">
                            Verified
                            <i class="fas fa-chevron-down ms-2"></i>
                        </button>
                        <div class="collapse show" id="verificationCollapse">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="verified" value="verified">
                                <label class="form-check-label" for="verified">Verified</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="unverified" value="unverified">
                                <label class="form-check-label" for="unverified">Unverified</label>
                            </div>
                        </div>
                        <hr class="line">
                    </div>

                    <div class="field-section mb-3">
                        <label class="btn w-100 btn-dropdown text-start" type="button" data-bs-toggle="collapse"
                            data-bs-target="#fieldCollapse" aria-expanded="false" aria-controls="fieldCollapse">
                            Lĩnh vực
                            <i class="fas fa-chevron-down ms-2"></i>
                        </label>
                        <div class="collapse show" id="fieldCollapse">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="AffiliateMarketing"
                                    value="Affiliate Marketing">
                                <label class="form-check-label" for="AffiliateMarketing">Affiliate Marketing </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Analytics" value="Analytics">
                                <label class="form-check-label" for="Analytics">Analytics</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="CallCenter" value="Call Center">
                                <label class="form-check-label" for="CallCenter">Call Center</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="CDP" value="CDP">
                                <label class="form-check-label" for="CDP">CDP</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Chatbot" value="Chatbot">
                                <label class="form-check-label" for="Chatbot">Chatbot</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="CRM" value="CRM">
                                <label class="form-check-label" for="CRM">CRM</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="CustomerService"
                                    value="Customer Service">
                                <label class="form-check-label" for="CustomerService">Customer Service</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Ecommerce" value="Ecommerce">
                                <label class="form-check-label" for="Ecommerce">Ecommerce</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">
                <div class="d-flex justify-content-end">
                    <div class="search-bar-field">
                        <input type="text" placeholder="Nhập từ khóa tìm kiếm ...">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    @for ($i = 0; $i < 15; $i++)
                        <div class="col-6 col-md-4 col-lg-4 d-flex company-list">
                            <a href="{{ route('company.detail') }}" class="company-link">
                                <div class="company-detail" align="center" data-aos="fade-up">
                                    <img src="{{ asset('frontend/image/DaNang.png') }}" alt="Đà Nẵng"
                                        class="img-company" loading="lazy">
                                    <p class="name-company">VietSunCo</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2" style="font-size: 13px">1231212đ</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>

                <nav aria-label="Page navigation example ">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <style>
        .sort-dropdown .btn-dropdown:hover {
            background-color: #fff;
            color: #3EAEF4;
            border: 1px solid #3EAEF4;
        }

        .btn-dropdown {
            cursor: pointer;
            background-color: #fff;
            color: #3EAEF4;
            border: 1px solid #3EAEF4;
        }

        .sort-dropdown .dropdown .btn-dropdown.show {
            color: #3EAEF4;
            background-color: #fff;
            border: 1px solid #3EAEF4;
        }

        .filter-container {
            font-family: Arial, sans-serif;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .sort-dropdown button {
            background-color: #fff;
            border: 1px solid #3EAEF4;
            color: #000;
            padding: 8px;
            width: 100%;
            text-align: left;
            border-radius: 4px;
        }

        .filter-section h3 {
            font-size: 18px;
            color: #3EAEF4;
            margin-top: 16px;
            font-weight: bold;
            padding: 8px 0;
        }

        .clear-filter {
            background-color: #3EAEF4;
            color: white;
            border: none;
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 8px;
        }

        .line {
            border: 0;
            height: 2px;
            background-color: #3EAEF4;
            margin: 16px 0;
        }

        .rating-section .btn-dropdown,
        .verification-section .btn-dropdown,
        .field-section .btn-dropdown {
            color: #3EAEF4;
            font-size: 18px;
            font-weight: 600;
            background-color: transparent;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
        }

        .btn-dropdown:hover,
        .btn-dropdown:focus,
        .btn-dropdown:active,
        .btn-dropdown:focus-visible {
            color: #3EAEF4;
            background-color: #3EAEF4;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }

        .form-check-input {
            margin-right: 8px;
        }

        .form-check-label {
            color: #333;
        }

        .form-check-label span {
            color: gold;
            font-size: 26px;
        }

        .pagination .page-item .page-link {
            color: #007bff;
            border: 1px solid #007bff;
        }

        .pagination .page-item .page-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        /*  */

        .search-bar-field {
            display: flex;
            align-items: center;
            border: 1px solid #3EAEF4;
            border-radius: 12px;
            padding: 8px 12px;
            width: 300px;
            margin: 20px 0;
        }

        .search-bar-field input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: #555;
        }

        .search-bar-field button {
            background: none;
            border: none;
            cursor: pointer;
            color: #3EAEF4;
            font-size: 16px;
        }

        .search-bar-field button:focus {
            outline: none;
        }
    </style>
@endsection
