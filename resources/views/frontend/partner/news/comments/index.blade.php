@extends('frontend.partner.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>All {{-- comment --}}</h1>
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
                                    {{-- <th>Hành động</th> --}}
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
                    url: '{{ route('api.new.showAllCommentInNewsById', ['id' => $id]) }}',
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
                        data: 'user_id'
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            let checked = data == 1 ? 'checked' : '';
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

                            return `
                                <a href="${editUrl}" class="btn btn-primary btn-sm btn-edit" data-id="${row.id}">
                                    <i class='far fa-edit'></i>
                                </a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${row.id}" data-url="/api/new/${row.id}">
                                    <i class='far fa-trash-alt'></i>
                                </button>
                            `;
                        }
                    }
                ]
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
