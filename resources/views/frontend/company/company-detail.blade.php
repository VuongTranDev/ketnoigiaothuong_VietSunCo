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
            <img src="{{ asset($company->image) }}" alt="Công ty ..." width="600px">
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div>
                    <h2 class="title-b2b">Giới thiệu</h2>
                    <hr class="line-title">
                </div>
                <p style="text-align: justify">{{ @$company->content }}</p>
                <div>
                    <h2 class="title-b2b">Thông tin chung</h2>
                    <hr class="line-title">
                </div>
                <div class="company-info">
                    <table class="info-table">
                        <tr>
                            <td><b>Tên công ty:</b></td>
                            <td>{{ $company->company_name ?? 'Đang cập nhật' }}</td>
                        </tr>
                        <tr>
                            <td><b>Tên viết tắt:</b></td>
                            <td>{{ $company->short_name ?? 'Đang cập nhật' }}</td>
                        </tr>
                        <tr>
                            <td><b>Người đại diện:</b></td>
                            <td>{{ $company->representative ?? 'Đang cập nhật' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $company->email ?? 'Đang cập nhật' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Mã số thuế:</strong></td>
                            <td>{{ $company->tax_code ?? 'Đang cập nhật' }}</td>
                        </tr>
                        <tr>
                            <td><b>Lĩnh vực:</b></td>
                            <td>
                                @if (!empty($categories) && $categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                @else
                                    Đang cập nhật
                                @endif
                            </td>
                        </tr>
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
                            <span class="rating-score">{{ $companyPoint }}/5</span>

                            <div class="stars read-only-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($companyPoint >= $i)
                                        <span class="filled">&#9733;</span> {{-- Sao đầy --}}
                                    @elseif ($companyPoint > $i - 1 && $companyPoint < $i)
                                        <span class="half-filled">&#9733;</span> {{-- Sao nửa --}}
                                    @else
                                        <span>&#9733;</span> {{-- Sao trống --}}
                                    @endif
                                @endfor
                            </div>
                            <span class="total-reviews">Tổng số đánh giá ({{ $allRating }})</span>
                        </div>
                        <div class="detailed-ratings">
                            @foreach ($starRating as $star => $count)
                                <p>{{ $star }} <label class=" count stars ">★</label> ({{ $count }} đánh
                                    giá)</p>
                            @endforeach

                        </div>
                    </div>

                    <div class="reviews-list">

                        @if (empty($ratings))
                            <div class="no-rating">
                                Công ty chưa có đánh giá nào.
                            </div>
                        @else
                            @foreach ($ratings as $rating)
                                <div class="rating-item">
                                    <div class="rating-details">
                                        <div>
                                            <img src="{{ asset('frontend/image/icon.png') }}" alt="User Avatar"
                                                class="user-avatar">
                                            @if (isset($userId) && $rating->user_id === $userId)
                                                <span class="user-name">Bạn</span>
                                            @else
                                                <span class="user-name">{{ $rating->user->company->company_name }}</span>
                                            @endif

                                        </div>

                                        <div class="stars read-only-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="{{ $rating->numberstart >= $i ? 'filled' : '' }}">&#9733;</span>
                                            @endfor
                                        </div>
                                        <p class="review-text">{{ $rating->content }}</p>
                                    </div>
                                    <div class="more-options">⋮</div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                    <div class="modal-rating" id="modalRating" style="display:none;">
                        <div class="modal-content">
                            <span class="close-btn">&times;</span>
                            <div class="rating-header">
                                <h3>Số sao:</h3>
                                <div class="stars">
                                    <span data-star="1">&#9733;</span>
                                    <span data-star="2">&#9733;</span>
                                    <span data-star="3">&#9733;</span>
                                    <span data-star="4">&#9733;</span>
                                    <span data-star="5">&#9733;</span>
                                </div>
                            </div>
                            <textarea class="content-rating" placeholder="Nhập đánh giá của bạn..."></textarea>
                            <div class="modal-buttons">
                                <button class="cancel-btn">Hủy</button>
                                <button class="submit-btn-rating" id="submitbtnRating">Gửi</button>
                            </div>
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
                    <h3 class="company-name-detail"><a
                            href="{{ $company->link }}">{{ $company->company_name ?? 'Đang cập nhật' }}</a></h3>
                    <div class="info">
                        <p><i class="fas fa-envelope"></i>
                            <a href="mailto:{{ $company->email ?? '#' }}">{{ $company->email ?? 'Đang cập nhật' }}</a>
                        </p>
                        <p><i class="fa-solid fa-globe"></i>
                            <a href="{{ $company->link ?? '#' }}">{{ $company->link ?? 'Đang cập nhật' }}</a>
                        </p>
                        <p><i class="fas fa-phone-alt"></i>
                            <a
                                href="callto:{{ $company->phone_number ?? '' }}">{{ $company->phone_number ?? 'Đang cập nhật' }}</a>
                        </p>
                        @if (@$address->address == null)
                            <p><i class="fas fa-map-marker-alt"></i> Đang cập nhật</p>
                        @else
                            <p>
                                <i class="fas fa-map-marker-alt"></i>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(@$address->address) }}"
                                    target="_blank">
                                    {{ @$address->address }}
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>



        @include('frontend.company.components.company-news')



        {{-- @include('frontend.company.components.company-same-field') --}}


    </div>

    <style>
        .count {
            margin-top: -2%;
        }

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

        }

        .total-reviews {
            font-weight: bold;
            color: #333;
        }

        .detailed-ratings p {
            margin: 2px 0;
            font-size: 15px;
            display: flex;
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

        /* Modal- rating */
        .modal-rating {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 500px;
            padding: 20px;
            z-index: 1000;
        }

        .modal-content {
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 18px;
        }

        .rating-header {
            display: flex;
            align-items: center;

            margin-bottom: 15px;
        }

        .rating-header h3 {
            margin: 0;
            font-size: 18px;
            margin-right: 10px;
        }

        .stars {
            display: flex;
            gap: 5px;
        }

        .stars span {
            font-size: 30px;
            cursor: pointer;
            color: lightgray;
        }

        .stars span:hover,
        .stars span.hovered {
            color: gold;
        }


        .read-only-stars span.filled {
            color: gold;
        }

        .read-only-stars span.half-filled {
            position: relative;
            display: inline-block;


            overflow: hidden;
        }

        .read-only-stars span.half-filled::before {
            content: '\2605';
            position: absolute;
            top: 0;
            left: 0;
            width: 1em;
            height: 1em;
            color: gold;
            overflow: hidden;
            width: 50%;
        }




        textarea {
            width: 100%;
            height: 100px;
            margin-top: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            resize: none;
            font-size: 14px;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .submit-btn-rating {
            background-color: #3607f0;
            color: white;
        }

        /* End Modal- rating */
    </style>
@endsection


@push('scripts')
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const modal = document.getElementById("modalRating");
        //     const openBtn = document.querySelector(".write-review-btn");
        //     const closeBtn = document.querySelector(".close-btn");
        //     const cancelBtn = document.querySelector(".cancel-btn");
        //     const submitBtn = document.querySelector(".submit-btn-rating");
        //     const stars = modal.querySelectorAll(".stars span"); // Chỉ lấy ngôi sao trong modal
        //     const textarea = modal.querySelector(".content-rating"); // Chỉ textarea trong modal

        //     let selectedRating = 0;

        //     if (openBtn) {
        //         openBtn.addEventListener("click", function() {
        //             console.log("Open button clicked");
        //             modal.style.display = "block";
        //         });
        //     }

        //     if (closeBtn) closeBtn.addEventListener("click", closeModal);
        //     if (cancelBtn) cancelBtn.addEventListener("click", closeModal);

        //     function closeModal() {
        //         modal.style.display = "none";
        //     }

        //     stars.forEach((star, index) => {
        //         star.addEventListener("mouseover", function() {
        //             highlightStars(index + 1);
        //         });

        //         star.addEventListener("mouseout", function() {
        //             highlightStars(selectedRating); // Reset về số sao đã chọn
        //         });

        //         star.addEventListener("click", function() {
        //             selectedRating = index + 1;
        //             highlightStars(selectedRating);
        //         });
        //     });

        //     function highlightStars(rating) {
        //         stars.forEach((star, index) => {
        //             star.classList.toggle("hovered", index < rating); // Đánh dấu các sao được chọn
        //         });
        //     }

        //     if (submitBtn) {
        //         submitBtn.addEventListener("click", function() {
        //             console.log("Submit button clicked");
        //             const content = textarea.value.trim();
        //             const numberstart = selectedRating;
        //             const company_id = @json($company->id); // ID công ty

        //             console.log('Company ID:', company_id);
        //             console.log('Selected rating:', selectedRating);
        //             console.log('Content:', content);

        //             closeModal();

        //             if (content && numberstart > 0) {
        //                 $.ajax({
        //                     url: "{{ route('createRating') }}",
        //                     method: 'POST',
        //                     data: {
        //                         _token: "{{ csrf_token() }}",
        //                         content: content,
        //                         numberstart: numberstart,
        //                         company_id: company_id
        //                     },
        //                     success: function(response) {
        //                         if (response.status === 'success') {
        //                             location.reload();
        //                             toastr.success(response.message);
        //                         } else {
        //                             toastr.error(response.message);
        //                         }
        //                     },
        //                     error: function(data) {
        //                         alert("Có lỗi xảy ra. Vui lòng thử lại.");
        //                         console.error("Error:", data);
        //                     }
        //                 });
        //             } else {
        //                 alert("Vui lòng nhập nội dung và chọn số sao.");
        //             }
        //         });
        //     }
        // });

        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("modalRating");
            const openBtn = document.querySelector(".write-review-btn");
            const closeBtn = document.querySelector(".close-btn");
            const cancelBtn = document.querySelector(".cancel-btn");
            const submitBtn = document.querySelector(".submit-btn-rating");
            const stars = modal.querySelectorAll(".stars span");
            const textarea = modal.querySelector(".content-rating");

            let selectedRating = 0;

            if (openBtn) {
                openBtn.addEventListener("click", function() {
                    modal.style.display = "block";
                });
            }

            if (closeBtn) closeBtn.addEventListener("click", closeModal);
            if (cancelBtn) cancelBtn.addEventListener("click", closeModal);

            function closeModal() {
                modal.style.display = "none";
            }

            stars.forEach((star, index) => {
                star.addEventListener("mouseover", function() {
                    highlightStars(index + 1);
                });

                star.addEventListener("mouseout", function() {
                    highlightStars(selectedRating);
                });

                star.addEventListener("click", function() {
                    selectedRating = index + 1;
                    highlightStars(selectedRating);
                });
            });

            function highlightStars(rating) {
                stars.forEach((star, index) => {
                    star.classList.toggle("hovered", index < rating);
                });
            }

            if (submitBtn) {
                submitBtn.addEventListener("click", function() {
                    const content = textarea.value.trim();
                    const numberstart = selectedRating;
                    const company_id = @json($company->id);

                    if (content && numberstart > 0) {
                        $.ajax({
                            url: "{{ route('createRating') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                content: content,
                                numberstart: numberstart,
                                company_id: company_id
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    closeModal();
                                    textarea.value = '';
                                    selectedRating = 0;
                                    highlightStars(selectedRating);

                                    addNewReview(content, numberstart);

                                    toastr.success(response.message);
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(data) {
                                alert("Có lỗi xảy ra. Vui lòng thử lại.");
                                console.error("Error:", data);
                            }
                        });
                    } else {
                        alert("Vui lòng nhập nội dung và chọn số sao.");
                    }
                });
            }

            function addNewReview(content, numberstart) {
                const reviewsList = document.querySelector(".reviews-list");

                // Xóa thông báo "Công ty chưa có đánh giá nào" nếu có
                const noRatingMessage = reviewsList.querySelector(".no-rating");
                if (noRatingMessage) {
                    noRatingMessage.remove();
                }

                // Tạo HTML cho đánh giá mới
                const newReviewHTML = `
            <div class="rating-item">
                <div class="rating-details">
                    <div>
                        <img src="{{ asset('frontend/image/icon.png') }}" alt="User Avatar" class="user-avatar">
                        <span class="user-name">Bạn</span>
                    </div>

                    <div class="stars read-only-stars">
                        ${[...Array(5)].map((_, i) =>
                            `<span class="${i < numberstart ? 'filled' : ''}">&#9733;</span>`).join('')}
                    </div>
                    <p class="review-text">${content}</p>
                </div>
                <div class="more-options">⋮</div>
            </div>
        `;

                // Chèn HTML mới vào đầu danh sách
                reviewsList.insertAdjacentHTML('afterbegin', newReviewHTML);
            }
        });
    </script>
@endpush
