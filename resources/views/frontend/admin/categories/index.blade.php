@extends('frontend.admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lĩnh vực</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả lĩnh vực</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Tạo mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Tag</th>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Chỉnh sửa tin tức</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <input type="hidden" id="editId">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="editTitle" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                ajax: {
                    url: '{{ route('api.categories') }}',
                    dataSrc: 'data'
                },
                columns: [{
                        data: null,
                        className: "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'slug'
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

                            let editUrl = `{{ route('admin.categories.edit', ':id') }}`.replace(':id', row.id);

                            return `
                                <a href="${editUrl}" class="btn btn-primary btn-sm btn-edit" data-id="${row.id}">
                                    <i class='far fa-edit'></i>
                                </a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${row.id}" data-url="/api/categories/${row.id}">
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
                            url: `/api/categories/${id}`,
                            type: 'DELETE',
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire(
                                    'Thành công!',
                                    'Delete category successfully.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Lỗi!',
                                    'Delete category unsuccessfully.',
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
