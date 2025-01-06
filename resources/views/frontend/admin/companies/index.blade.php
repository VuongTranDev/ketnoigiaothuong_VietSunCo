@extends('frontend.admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản lý công ty</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả công ty</h4>
                        </div>
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên công ty</th>
                                        <th>Số điện thoại</th>
                                        <th>Website</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        {{-- <th>Ngày cập nhật</th> --}}
                                        <th>Hành động</th>
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
            var table = $('#example').DataTable({
                ajax: {
                    url: 'http://127.0.0.1:8002/api/company?limit=50&page=1',
                    dataSrc: 'data'
                },
                columns: [{
                        data: null,
                        className: "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }, {
                        data: 'company_name'
                    },
                    {
                        data: 'phone_number'
                    },
                    {
                        data: 'link'
                    },
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
                        data: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    // {
                    //     data: 'updated_at',
                    //     render: function(data, type, row) {
                    //         return moment(data).format('DD-MM-YYYY');
                    //     }
                    // },
                    {
                        data: null,
                        className: "dt-center",
                        orderable: false,
                        render: function(data, type, row) {
                            let editUrl = `{{ route('admin.companies.detail', ':id') }}`.replace(':id', row
                                .id);
                            return `
                                <a href="${editUrl}" class="btn btn-primary btn-sm btn-edit"  data-id="${row.id}">
                                    <i class='far fa-eye'></i>
                                </a>
                            `;
                        }
                    }
                ]
            });
            $('#example').on('change', '.change-status', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: `/api/company/status/${id}`,
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
        });
    </script>
@endpush
