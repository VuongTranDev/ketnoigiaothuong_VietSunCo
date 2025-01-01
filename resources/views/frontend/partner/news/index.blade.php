@extends('frontend.partner.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tin tức</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả tin tức</h4>
                            <div class="card-header-action">
                                <a href="{{ route('partner.news.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Tạo mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Hình ảnh</th>
                                        <th>Nội dung</th>
                                        <th>Trạng thái</th>
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
                        <div class="mb-3">
                            <label for="editContent" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="editContent" rows="3" required></textarea>
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
        const assetBaseUrl = "{{ asset('') }}";
        $(document).ready(function() {
            var table = $('#example').DataTable({

                ajax: {
                    url: '{{ route('api.news.showNewsByUserId', ['user_id' => session('user')->id]) }}',
                    dataSrc: 'data'
                },
                columns: [{
                        data: null,
                        className: "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }, {
                        data: 'title'
                    },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            return `<img src="${assetBaseUrl}${data}" alt="" width="100">`;
                        }
                    },
                    {
                        data: 'content',
                        render: function(data, type, row) {
                            let parser = new DOMParser();
                            let doc = parser.parseFromString(data, 'text/html');
                            let textContent = doc.body.textContent || "";

                            return textContent.length > 50 ? textContent.substring(0, 50) + '...' :
                                textContent;
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            let checked = data == 1 ?  'checked' : '';
                            return `
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" ${checked}
                                        name="custom-switch-checkbox"
                                        data-id="${row.id}"
                                        class="custom-switch-input change-status">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            `;
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: null,
                        className: "dt-center",
                        orderable: false,
                        render: function(data, type, row) {

                            let editUrl = `{{ route('partner.news.edit', ':id') }}`.replace(':id',
                                row
                                .id);
                            let listNewsUrl = `{{ route('partner.comment.list.index', ':id') }}`.replace(':id',
                                row
                                .id);
                            return `
                                <a href="${editUrl}" class="btn btn-primary btn-sm btn-edit" data-id="${row.id}">
                                    <i class='far fa-edit'></i>
                                </a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${row.id}" data-url="/api/new/${row.id}">
                                    <i class='far fa-trash-alt'></i>
                                </button>
                                <a href="${listNewsUrl}" class="btn btn-primary btn-sm btn-edit" data-id="${row.id}">
                                    <i class='far fa-eye'></i>
                                </a>
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

            $('body').on('change', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('partner.news.change-status') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        status: isChecked ? 'true' : 'false',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Đã xảy ra lỗi khi cập nhật trạng thái.');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
