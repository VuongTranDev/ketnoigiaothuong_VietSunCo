@extends('frontend.admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sao lưu phục hồi</h1>
        </div>
        <div class="backup-container">
            <div class="backup-grid">
                <div class="backup-card">
                    <h2>Sao lưu</h2>
                    <p>Chọn vào nút ở dưới để bắt đầu quá trình sao lưu dữ liệu.</p>
                    <form action="{{ route('admin.backupDB') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-backup text-light">
                            <i class="fas fa-cloud-upload-alt"></i> Sao lưu ngay
                        </button>
                    </form>
                    <div class="custom-hr"></div>
                    <form action="{{ route('admin.backup.schedule') }}" method="POST">
                        @csrf
                        <p>Chọn vào thời gian ở dưới để bắt đầu sao lưu dữ liệu theo lịch.</p>
                        <div class="backup-schedule-options">
                            <div class="form-group" id="weekly_options" style="display: none;margin-bottom:-5px">
                                <label for="backup_day">Ngày trong tuần :</label>
                                <select name="backup_day" id="backup_day" class="form-control">
                                    <option value="">Chọn ngày trong tuần</option>
                                    <option value="Sunday">Chủ nhật</option>
                                    <option value="Monday">Thứ 2</option>
                                    <option value="Tuesday">Thứ 3</option>
                                    <option value="Wednesday">Thứ 4</option>
                                    <option value="Thursday">Thứ 5</option>
                                    <option value="Friday">Thứ 6</option>
                                    <option value="Saturday">Thứ 7</option>
                                </select>
                            </div>
                            <label for="backup-time">Chọn giờ :</label>
                            <input type="time" id="backup-time" name="backup_time">
                            <label for="backup-frequency">Chọn tần suất :</label>
                            <select name="backup_frequency" id="backup_frequency">
                                <option value="daily">Hàng ngày</option>
                                <option value="weekly">Hàng tuần</option>
                                <option value="monthly">Hàng tháng</option>
                            </select>
                        </div>
                        <div class="form-group" id="monthly_options" style="display: none;">
                            <label for="backup_day_of_month">Ngày trong tháng :</label>
                            <input type="number" name="backup_day_of_month" id="backup_day_of_month" class="form-control"
                                min="1" max="31">
                        </div>
                        <button type="submit" class="btn-backup text-light">
                            <i class="fas fa-cloud-download-alt"></i>Sao lưu theo lịch
                        </button>
                    </form>
                    <div class="custom-hr"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn-backup text-light" id="viewScheduleBtn" data-bs-toggle="modal"
                                data-bs-target="#backupScheduleModal">
                                <i class="fas fa-cloud-download-alt"></i> Xem lịch sao lưu
                            </button>
                        </div>
                        <div class="col-md-6 ">
                            <button type="submit" class="btn-backup text-light" id="deleteALLSchedule" >
                                <i class="fas fa-cloud-download-alt"></i> Xoá tất cả lịch sao lưu
                            </button>
                        </div>
                    </div>

                </div>
                <div class="backup-card">
                    <h2>Phục hồi</h2>
                    <p>Chọn vào nút ở dưới để bắt đầu quá trình phục hồi dữ liệu.</p>
                    <form action="{{ route('admin.restore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="backup_file" class="backup-file-upload">
                        <button class="btn-backup text-light">
                            <i class="fas fa-cloud-download-alt"></i> Bắt đầu phục hồi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="backupScheduleModal" tabindex="-1" aria-labelledby="backupScheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backupScheduleModalLabel">Lịch sao lưu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Danh sách các lịch sao lưu hiện tại sẽ hiển thị ở đây.</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Thời gian</th>
                                <th>Tần suất</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="scheduleTableBody">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('backup_frequency').addEventListener('change', function() {
                var frequency = this.value;
                document.getElementById('weekly_options').style.display = (frequency === 'weekly') ? 'block' : 'none';
                document.getElementById('monthly_options').style.display = (frequency === 'monthly') ? 'block' : 'none';
                if (frequency !== 'monthly') {
                    document.getElementById('backup_day_of_month').required = false;
                } else {
                    document.getElementById('backup_day_of_month').required = true;
                }
            });
        </script>
        <script>
            $('#viewScheduleBtn').on('click', function() {
                $.ajax({
                    url: '{{ route('get.backup') }}',
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === "success" && Array.isArray(response.data)) {
                            let schedules = response.data;
                            let tableBody = $('#scheduleTableBody');
                            tableBody.empty(); // Clear existing content
                            schedules.forEach((schedule, index) => {
                                let frequencyDisplay;
                                if (schedule.frequency === 'weekly') {
                                    frequencyDisplay =
                                        `${schedule.frequency}, ${schedule.backup_day}`;
                                } else if (schedule.frequency === 'monthly') {
                                    frequencyDisplay =
                                        `${schedule.frequency}, ${schedule.backup_day_of_month}`;
                                } else {
                                    frequencyDisplay = schedule.frequency;
                                }
                                tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${schedule.backup_time}</td>
                            <td>${frequencyDisplay}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="deleteSchedule(${schedule.id})">Xoá</button>
                            </td>
                        </tr>
                    `);
                            });
                        } else {
                            console.error('Invalid response format or data is not an array:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching schedules:', error);
                    }
                });
            });

            $('#deleteALLSchedule').on('click', function() {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa mục này?',
                    text: "Hành động này không thể hoàn tác!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('delete.Allschedule') }}',
                            type: 'DELETE',
                            success: function(response) {
                                Swal.fire(
                                    'Thành công!',
                                    'Xóa lịch thành công.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Lỗi!',
                                    'Đã xảy ra lỗi khi xóa.',
                                    'error'
                                );
                            }
                        });
                    }
                });

            });

            function deleteSchedule(id) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa mục này?',
                    text: "Hành động này không thể hoàn tác!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/api/backup/${id}`,
                            type: 'DELETE',
                            success: function(response) {
                                $('#viewScheduleBtn').click();
                                Swal.fire(
                                    'Thành công!',
                                    'Xóa lịch thành công.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Lỗi!',
                                    'Đã xảy ra lỗi khi xóa.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
