@extends('frontend.admin.layout.master')

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
                                <a href="" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Tạo mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    {{-- <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let mablogtour = $(this).data('id');

                console.log({
                    mablogtour: mablogtour,
                    trangthaiblog: isChecked ? 'true' : 'false'
                });

                $.ajax({
                    url: "{{ route('blog.change-status') }}",
                    method: 'POST',
                    data: {
                        mablogtour: mablogtour,
                        trangthaiblog: isChecked ? 'true' : 'false'
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr) {
                        console.log(error);
                    }
                });
            });
        });
    </script> --}}
@endpush
