@extends('frontend.layout.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/filter.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/company.css') }}"> --}}
@endpush

@section('renderBody')
    <div class="container-xl pt-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pt-2 pb-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách công ty tìm được</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-3">
                {{-- @include('frontend.company.components.filter-sidebar') --}}
                <div class="filter-container mt-3">
                    {{-- <div class="sort-dropdown">
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
                    </div> --}}

                    {{-- <div class="filter-section">
                        <h3>Bộ lọc tìm kiếm</h3>
                        <button class="clear-filter">Bỏ chọn tất cả ✕</button>
                        <hr class="line">
                    </div> --}}

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
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="alrting" id="alrating"
                                    value="alrating">
                                <label class="form-check-label" for="alrating"><span>Tất cả</span></label>
                            </div>
                        </div>

                        <hr class="line">
                    </div>

                    {{-- <div class="verification-section mb-3">
                        <button class="btn w-100 btn-dropdown text-start" type="button" data-bs-toggle="collapse"
                            data-bs-target="#verificationCollapse" aria-expanded="false" aria-controls="verificationCollapse">
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
                    </div> --}}

                    <div class="field-section mb-3">
                        <label class="btn w-100 btn-dropdown text-start" type="button" data-bs-toggle="collapse"
                            data-bs-target="#fieldCollapse" aria-expanded="false" aria-controls="fieldCollapse">
                            Lĩnh vực
                            <i class="fas fa-chevron-down ms-2"></i>
                        </label>
                        <div class="collapse show" id="fieldCollapse">
                            @foreach ($category as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="category{{ $item->name }}"
                                        value="{{ $item->name }}">
                                    <label class="form-check-label"
                                        for="category{{ $item->name }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
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
                    @if ($companiesData && count($companiesData) > 0)
                        @foreach ($companiesData as $item)
                            <div class="col-6 col-lg-4 col-md-4 company-list" data-average-rating="{{ $item->point }}">
                                <a href="{{ route('company.detail', $item->slug) }}" class="company-link">
                                    <div class="company-detail" align="center" data-aos="fade-up">
                                        <img src="{{ asset($item->image) }}" alt="Đà Nẵng"
                                            class="img-company" loading="lazy">
                                        <p class="name-company">{{ $item->company_name }}</p>
                                        <p class="short-name">{{ $item->short_name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <h3>Hiện không có công ty nào ở lĩnh vực này.</h3>
                        </div>
                    @endif
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
@endsection


@push('scripts')
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Lấy tất cả các radio button rating
        //     const ratings = document.querySelectorAll('input[name="rating"]');

        //     // Lấy tất cả các công ty
        //     const companies = document.querySelectorAll('.company-list');

        //     // Hàm để lọc công ty theo rating đã chọn
        //     function filterCompanies() {
        //         let selectedRating = null;

        //         // Lấy rating đã chọn (chỉ một rating duy nhất)
        //         ratings.forEach(rating => {
        //             if (rating.checked) {
        //                 selectedRating = parseInt(rating.value); // Lấy giá trị rating (1, 2, 3, 4, 5)
        //             }
        //         });

        //         // Nếu không có rating nào được chọn, hiển thị tất cả các công ty
        //         if (selectedRating === null) {
        //             companies.forEach(company => {
        //                 company.style.display = 'block'; // Đảm bảo công ty sẽ được hiển thị
        //             });
        //             return;
        //         }

        //         // Duyệt qua tất cả các công ty và ẩn/hiện dựa trên điểm rating
        //         companies.forEach(company => {
        //             const companyRating = parseFloat(company.querySelector('.rating-company').textContent
        //                 .trim()); // Lấy điểm rating của công ty

        //             // Kiểm tra nếu điểm của công ty phù hợp với rating đã chọn
        //             if (selectedRating === 5 && companyRating === 5) {
        //                 company.style.display = 'block'; // Hiển thị công ty nếu điểm 5
        //             } else if (selectedRating === 4 && companyRating >= 4 && companyRating < 5) {
        //                 company.style.display = 'block'; // Hiển thị công ty nếu điểm từ 4 đến dưới 5
        //             } else if (selectedRating === 3 && companyRating >= 3 && companyRating < 4) {
        //                 company.style.display = 'block'; // Hiển thị công ty nếu điểm từ 3 đến dưới 4
        //             } else if (selectedRating === 2 && companyRating >= 2 && companyRating < 3) {
        //                 company.style.display = 'block'; // Hiển thị công ty nếu điểm từ 2 đến dưới 3
        //             } else if (selectedRating === 1 && companyRating >= 1 && companyRating < 2) {
        //                 company.style.display = 'block'; // Hiển thị công ty nếu điểm từ 1 đến dưới 2
        //             } else {
        //                 company.style.display = 'none'; // Ẩn công ty nếu điểm không phù hợp
        //             }
        //         });
        //     }

        //     // Gắn sự kiện khi thay đổi radio button
        //     ratings.forEach(rating => {
        //         rating.addEventListener('change', filterCompanies);
        //     });

        //     // Khởi tạo trạng thái ban đầu (hiển thị tất cả các công ty)
        //     filterCompanies();
        // });

        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các radio button rating
            const ratings = document.querySelectorAll('input[name="rating"]');

            // Lấy radio button "Tất cả"
            const allRating = document.querySelector('#alrating');

            // Lấy tất cả các checkbox lĩnh vực
            const categoryCheckboxes = document.querySelectorAll('.field-section .form-check-input');

            // Lấy tất cả các công ty
            const companies = document.querySelectorAll('.company-list');

            // Hàm lọc công ty theo rating đã chọn và category đã chọn
            function filterCompanies() {
                let selectedRating = null;

                // Kiểm tra nếu người dùng đã chọn "Tất cả"
                if (allRating.checked) {
                    selectedRating = null; // Khi "Tất cả" được chọn, bỏ rating
                } else {
                    // Lấy rating đã chọn (chỉ một rating duy nhất)
                    ratings.forEach(rating => {
                        if (rating.checked) {
                            selectedRating = parseInt(rating.value); // Lấy giá trị rating (1, 2, 3, 4, 5)
                        }
                    });
                }

                // Lấy danh sách các category được chọn
                const selectedCategories = Array.from(categoryCheckboxes)
                    .filter(checkbox => checkbox.checked) // Lấy các checkbox được chọn
                    .map(checkbox => checkbox.value.toLowerCase()); // Chuyển giá trị các category thành chữ thường

                // Nếu không có rating hoặc category nào được chọn, hiển thị tất cả các công ty
                companies.forEach(company => {
                    let companyRating = parseFloat(company.querySelector('.rating-company').textContent
                        .trim()); // Lấy điểm rating của công ty
                    const companyCategories = company.querySelector('.categories')
                        .textContent.trim()
                        .toLowerCase()
                        .split(', '); // Lấy danh sách categories của công ty

                    // Kiểm tra xem công ty có phù hợp với rating đã chọn
                    let matchesRating = false;
                    if (selectedRating !== null) {
                        if (selectedRating === 5 && companyRating === 5) {
                            matchesRating = true;
                        } else if (selectedRating === 4 && companyRating >= 4 && companyRating < 5) {
                            matchesRating = true;
                        } else if (selectedRating === 3 && companyRating >= 3 && companyRating < 4) {
                            matchesRating = true;
                        } else if (selectedRating === 2 && companyRating >= 2 && companyRating < 3) {
                            matchesRating = true;
                        } else if (selectedRating === 1 && companyRating >= 1 && companyRating < 2) {
                            matchesRating = true;
                        }
                    } else {
                        matchesRating =
                        true; // Nếu không có rating được chọn, cho phép tất cả các công ty hiển thị
                    }

                    // Kiểm tra xem công ty có thuộc các category đã chọn không
                    let matchesCategory = selectedCategories.length === 0 || selectedCategories.some(
                        category => companyCategories.includes(category));

                    // Hiển thị hoặc ẩn công ty dựa trên cả rating và category
                    if (matchesRating && matchesCategory) {
                        company.style.display = 'block';
                    } else {
                        company.style.display = 'none';
                    }
                });
            }

            // Gắn sự kiện khi thay đổi rating, checkbox category hoặc "Tất cả"
            ratings.forEach(rating => {
                rating.addEventListener('change', function() {
                    // Nếu người dùng chọn bất kỳ rating nào, bỏ chọn radio "Tất cả"
                    if (allRating.checked) {
                        allRating.checked = false;
                    }
                    filterCompanies();
                });
            });

            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', filterCompanies);
            });

            // Gắn sự kiện khi chọn "Tất cả"
            allRating.addEventListener('change', function() {
                // Bỏ chọn tất cả các rating khác khi chọn "Tất cả"
                ratings.forEach(rating => {
                    rating.checked = false;
                });
                // Khởi động lại lọc khi chọn "Tất cả"
                filterCompanies();
            });

            // Khởi tạo trạng thái ban đầu (hiển thị tất cả các công ty)
            filterCompanies();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả checkbox lĩnh vực
            const categoryCheckboxes = document.querySelectorAll('.field-section .form-check-input');

            // Lấy tất cả các radio button rating
            const ratings = document.querySelectorAll('input[name="rating"]');

            // Lấy tất cả các công ty
            const companies = document.querySelectorAll('.company-list');

            // Hàm lọc công ty theo rating đã chọn và lĩnh vực đã chọn
            function filterCompanies() {
                let selectedRating = null;

                // Lấy rating đã chọn (chỉ một rating duy nhất)
                ratings.forEach(rating => {
                    if (rating.checked) {
                        selectedRating = parseInt(rating.value); // Lấy giá trị rating (1, 2, 3, 4, 5)
                    }
                });

                // Lấy danh sách các category được chọn
                const selectedCategories = Array.from(categoryCheckboxes)
                    .filter(checkbox => checkbox.checked) // Lấy các checkbox được chọn
                    .map(checkbox => checkbox.value.toLowerCase()); // Chuyển giá trị các category thành chữ thường

                // Nếu không có rating và category nào được chọn, hiển thị tất cả các công ty
                companies.forEach(company => {
                    let companyRating = parseFloat(company.querySelector('.rating-company').textContent
                        .trim()); // Lấy điểm rating của công ty
                    const companyCategories = company.querySelector('.categories')
                        .textContent.trim()
                        .toLowerCase()
                        .split(', '); // Lấy danh sách categories của công ty

                    // Kiểm tra xem công ty có phù hợp với rating đã chọn
                    let matchesRating = false;
                    if (selectedRating !== null) {
                        if (selectedRating === 5 && companyRating === 5) {
                            matchesRating = true;
                        } else if (selectedRating === 4 && companyRating >= 4 && companyRating < 5) {
                            matchesRating = true;
                        } else if (selectedRating === 3 && companyRating >= 3 && companyRating < 4) {
                            matchesRating = true;
                        } else if (selectedRating === 2 && companyRating >= 2 && companyRating < 3) {
                            matchesRating = true;
                        } else if (selectedRating === 1 && companyRating >= 1 && companyRating < 2) {
                            matchesRating = true;
                        }
                    } else {
                        matchesRating =
                            true; // Nếu không có rating được chọn, cho phép tất cả các công ty hiển thị
                    }

                    // Kiểm tra xem công ty có thuộc các category đã chọn không
                    let matchesCategory = selectedCategories.length === 0 || selectedCategories.some(
                        category => companyCategories.includes(category));

                    // Hiển thị hoặc ẩn công ty dựa trên cả rating và category
                    if (matchesRating && matchesCategory) {
                        company.style.display = 'block';
                    } else {
                        company.style.display = 'none';
                    }
                });
            }

            // Gắn sự kiện "change" vào tất cả các radio button rating và checkbox category
            ratings.forEach(rating => {
                rating.addEventListener('change', filterCompanies);
            });

            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', filterCompanies);
            });

            // Khởi tạo trạng thái ban đầu (hiển thị tất cả các công ty)
            filterCompanies();
        });
    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ratings = document.querySelectorAll(
            'input[name="rating"]'); // Lấy tất cả các radio button cho Rating
            const categories = document.querySelectorAll(
            'input[name="category"]'); // Lấy tất cả các checkbox cho Category
            const companies = document.querySelectorAll('.company-list'); // Lấy tất cả các công ty trong danh sách

            // Hàm lọc các công ty dựa trên rating và category
            function filterCompanies() {
                let selectedRating = null;
                let selectedCategories = [];

                // Lấy rating đã chọn
                ratings.forEach(rating => {
                    if (rating.checked) {
                        selectedRating = parseInt(rating.value) ||
                        null; // Nếu không chọn rating, chọn tất cả
                    }
                });

                // Lấy các category đã chọn
                categories.forEach(category => {
                    if (category.checked) {
                        selectedCategories.push(category.value);
                    }
                });

                // Duyệt qua từng công ty để áp dụng bộ lọc
                companies.forEach(company => {
                    const companyRating = parseFloat(company.querySelector('.rating-company').textContent
                        .trim()); // Lấy điểm rating của công ty
                    const companyCategories = company.querySelector('.categories').textContent.split(
                    ','); // Lấy danh mục của công ty

                    // Kiểm tra rating của công ty (nếu có rating đã chọn)
                    const ratingMatches = selectedRating === null || companyRating >= selectedRating;

                    // Kiểm tra category của công ty (nếu có category đã chọn)
                    const categoryMatches = selectedCategories.length === 0 || selectedCategories.some(
                        cat => companyCategories.includes(cat));

                    // Hiển thị hoặc ẩn công ty dựa trên điều kiện
                    if (ratingMatches && categoryMatches) {
                        company.style.display = 'block';
                    } else {
                        company.style.display = 'none';
                    }
                });
            }

            // Gắn sự kiện thay đổi cho các phần tử rating và category
            ratings.forEach(rating => {
                rating.addEventListener('change', filterCompanies);
            });

            categories.forEach(category => {
                category.addEventListener('change', filterCompanies);
            });

            // Khởi tạo trạng thái ban đầu
            filterCompanies();
        });
    </script> --}}
@endpush
