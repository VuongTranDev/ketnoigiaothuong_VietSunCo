@extends('frontend.admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Địa chỉ</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả địa chỉ</h4>
                            <div class="card-header-action">
                                <a href="{{ route('partner.address.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Tạo mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example_wrapper" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mô tả</th>
                                        <th>Địa chỉ</th>
                                        <th>Công ty</th>
                                        <th>Ngày tạo</th>
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
            var table = $('#example_wrapper').DataTable({
                ajax: {
                    url: 'api/address/index',
                    method: 'GET',
                    dataSrc: 'data'
                },
                columns: [{
                        data: null,
                        className: "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }, {
                        data: 'details'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'company_id',
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: null,
                        className: "dt-center",
                        orderable: false,
                        render: function(data, type, row) {

                            let editUrl = `{{ route('partner.address.edit', ':id') }}`.replace(':id', row
                                .id);

                            return `
                                <a href="${editUrl}" class="btn btn-primary btn-sm btn-edit" data-id="${row.id}">
                                    <i class='far fa-edit'></i>
                                </a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${row.id}" data-url="/api/address/${row.id}">
                                    <i class='far fa-trash-alt'></i>
                                </button>
                            `;
                        }
                    }
                ]
            });

            $('#example').on('click', '.btn-delete', function() {
                var id = $(this).data('id');

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
                            url: `/api/new/${id}`,
                            type: 'DELETE',
                            success: function(response) {
                                table.ajax.reload();

                                Swal.fire(
                                    'Thành công!',
                                    'Xóa tin tức thành công.',
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
        });
    </script>
@endpush
