@extends('frontend.partner.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Transaction</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalTransaction }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-copyright"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Connect Companies</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalConnect }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Categories</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCategories }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total News</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalNews }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>




        </div>
        <style>
            .tour-statistics {
                padding: 20px;
                background-color: #fff;
                border-radius: 6px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .statistical {
                gap: 20px;
            }

            #ageDistributionChart {
                max-width: 600px;
                max-height: 500px;
                margin: 0 auto;
            }
        </style>

        <div class="section-body pb-4 w-auto">
            <!-- Hàng đầu tiên: Biểu đồ 1 và 2 -->
            {{-- <div class="d-flex w-100 statistical">
                <div class="tour-statistics" style="width: calc(100% / 3 * 2)">
                    <h3 style="text-align:center">News hot</h3>
                    <canvas id="popularNewsChart"></canvas>
                </div>

                <div class="tour-statistics">
                    <h3 style="text-align:center">Số lượng khách hàng đăng kí tài khoản</h3>
                    <canvas id="usersPieChart"></canvas>
                </div>
            </div> --}}

            <!-- Hàng thứ hai: Biểu đồ 3-->
            <div class="d-flex mt-4">
                <div class="tour-statistics w-100">
                    <h3 style="text-align:center">Danh sách công ty thân thiết</h3>
                    <canvas id="companyBarChart"></canvas>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            fetch('http://127.0.0.1:8002/api/report/statisticActivity/' + {{ session('user')->id }})
                .then(response => response.json())
                .then(responseData => {
                    const companyNames = responseData.data.map(item => item.company_name); // Tên công ty
                    const newsCounts = responseData.data.map(item => item.tong); // Số lượng bài viết

                    // Tạo mảng màu sắc động cho từng cột
                    const backgroundColors = responseData.data.map((_, index) => {
                        // Chọn màu sắc cho từng cột (bạn có thể tùy chỉnh logic này)
                        const colors = [
                            'rgba(54, 162, 235, 0.2)', // Màu 1
                            'rgba(255, 99, 132, 0.2)', // Màu 2
                            'rgba(75, 192, 192, 0.2)', // Màu 3
                            'rgba(153, 102, 255, 0.2)', // Màu 4
                            'rgba(255, 159, 64, 0.2)' // Màu 5
                        ];
                        return colors[index % colors.length]; // Chọn màu theo index
                    });

                    const borderColors = backgroundColors.map(color => color.replace('0.2',
                    '1')); // Thay đổi độ trong suốt của đường viền

                    new Chart(document.getElementById('companyBarChart'), {
                        type: 'bar',
                        data: {
                            labels: companyNames,
                            datasets: [{
                                label: 'Số lượng tin nhắn gửi đi',
                                data: newsCounts,
                                backgroundColor: backgroundColors, // Sử dụng mảng màu cho nền
                                borderColor: borderColors, // Sử dụng mảng màu cho đường viền
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        </script>
    @endpush
@endsection
