@extends('frontend.partner.layout.master')

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
                            <table id="example" class="display" style="width:100%">
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
            const table = $('#example').DataTable({
                ajax: {
                    url: '{{ route('api.address.showAddressByIdCompany', ['id' => session('user')->id]) }}',
                    dataSrc: function(response) {
                        return response.status === "success" && Array.isArray(response.data) ? response
                            .data : [];
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // STT
                        }
                    },
                    {
                        data: 'details' // Chi tiết
                    },
                    {
                        data: 'address' // Địa chỉ
                    },
                    {
                        data: 'company_id.company_name', // Tên công ty
                        render: function(data, type, row) {
                            return data ? data : 'Không có công ty';
                        }
                    },
                    {
                        data: 'created_at', // Ngày tạo
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: null, // Hành động
                        render: function(data, type, row) {
                            let editUrl = `{{ route('partner.address.edit', ':id') }}`.replace(
                                ':id', row.id);

                            return `
                        <a href="${editUrl}" class="btn btn-primary btn-sm btn-edit" data-id="${row.id}">
                            <i class='far fa-edit'></i>
                        </a>
                        <button class="btn btn-danger btn-delete" data-id="${row.id}">
                            Xóa
                        </button>`;
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
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/api/address/${id}`,
                            type: 'DELETE',
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire('Thành công!', 'Địa chỉ đã được xóa.',
                                    'success');
                            },
                            error: function(xhr) {
                                Swal.fire('Lỗi!', 'Không thể xóa địa chỉ.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
