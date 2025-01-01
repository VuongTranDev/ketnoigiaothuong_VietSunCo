@extends('frontend.partner.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>All comment </h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All comment</h4>
                        </div>
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Nội dung</th>
                                        <th>Người gửi</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>


        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('api.new.showAllCommentInNewsById', ['id' => $id]) }}',
                    dataSrc: function(response) {
                        if (response.status === "success" && response.data) {
                            return response.data; // Lấy dữ liệu từ 'data'
                        } else {
                            console.error("API trả về dữ liệu không hợp lệ:", response);
                            return [];
                        }
                    }
                },
                columns: [{
                        data: null,
                        className: "dt-center",
                        render: (data, type, row, meta) => meta.row + 1
                    }, // STT
                    {
                        data: 'content'
                    }, // Nội dung
                    {
                        data: 'user.email',
                        render: data => data || 'Không xác định'
                    }, // Người gửi
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            let checked = data === 1 ? 'checked' : ''; // Kiểm tra nếu status là 1
                            return `
            <label class="custom-switch mt-2">
                <input type="checkbox" ${checked} name="custom-switch-checkbox" data-id="${row.id}" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
            </label>`;
                        }
                    },
                    {
                        data: 'user.created_at',
                        render: data => data ? moment(data).format('DD-MM-YYYY') : 'Không xác định'
                    },

                ]
            });
        });

        $('#example').on('change', '.change-status', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: `/api/comments/status/${id}`,
                    type: 'PUT',
                    data: {
                        status: status
                    },
                    success: function(response) {
                        Swal.fire(
                            'Thành công!',
                            'Cập nhật trạng thái thành công.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Lỗi!',
                            'Đã xảy ra lỗi khi cập nhật trạng thái.',
                            'error'
                        );
                    }
                });
            });
    </script>
@endpush
