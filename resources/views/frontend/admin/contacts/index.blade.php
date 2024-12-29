@extends('frontend.admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Liên hệ</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Gửi email đến tất cả email đã gửi liên hệ</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.send-contact.send-bulk-email') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" class="form-control" name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label>Lời nhắn</label>
                                    <textarea name="message" class="form-control" required></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">Gửi</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả liên hệ</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.news.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Tạo mới</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Lời nhắn</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày gửi</th>
                                        <th>Chức năng</th>
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
        const assetBaseUrl = "{{ asset('') }}";
        $(document).ready(function() {
            var table = $('#example').DataTable({
                ajax: {
                    url: '{{ route('api.send-contact') }}',
                    dataSrc: 'data'
                },
                columns: [{
                        data: null,
                        className: "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }, {
                        data: 'name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'message',
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
                            console.log('Status:', data);
                            return data == 1 ?
                                '<span class="badge badge-info">Đã gửi</span>' :
                                '<span class="badge badge-warning">Chưa phản hồi</span>';
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

                            let editUrl = `{{ route('admin.news.edit', ':id') }}`.replace(':id', row
                                .id);

                            return `
                                <a href="${editUrl}" class="btn btn-primary btn-sm btn-edit" data-id="${row.id}">
                                    <i class='far fa-edit'></i>
                                </a>
                            `;
                        }
                    }
                ]
            });
        });
    </script>
@endpush
