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
                            <h4>Thêm địa chỉ</h4>
                            <div class="card-header-action">
                                <a href="{{ route('partner.address.index') }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_address">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ session('user')->id }}">

                                <div class="form-group">
                                    <label>Tên địa chỉ</label>
                                    <input type="text" class="form-control" name="details" required>
                                </div>

                                <div class="form-group">
                                    <label>Tỉnh</label>
                                    <select name="province_id" id="province_id" class="form-control" required>
                                        <option value="">Chọn tỉnh</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Huyện</label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="">Chọn huyện</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Xã</label>
                                    <select name="ward_id" id="ward_id" class="form-control" required>
                                        <option value="">Chọn xã</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Số nhà/Tên đường</label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                                <button type="submit" class="btn btn-primary create_address">Tạo mới</button>
                            </form>
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

            $('#province_id').change(function() {
                const provinceId = $(this).val();
                $('#district_id').html('<option value="">Đang tải huyện...</option>'); // Reset huyện
                $('#ward_id').html('<option value="">Chọn xã</option>'); // Reset xã

                if (provinceId) {
                    $.ajax({
                        url: `http://127.0.0.1:8002/api/districts/${provinceId}`, // Sử dụng URL động
                        method: 'GET',
                        success: function(response) {
                            $('#district_id').html('<option value="">Chọn huyện</option>');
                            if (response.length > 0) {
                                response.forEach(function(district) {
                                    $('#district_id').append(
                                        `<option value="${district.id}">${district.name}</option>`
                                    );
                                });
                            } else {
                                $('#district_id').html(
                                    '<option value="">Không có huyện</option>');
                            }
                        },
                        error: function() {
                            alert('Không thể tải danh sách huyện.');
                        }
                    });
                } else {
                    $('#district_id').html('<option value="">Chọn huyện</option>');
                    $('#ward_id').html('<option value="">Chọn xã</option>');
                }
            });

            $('#district_id').change(function() {
                const districtId = $(this).val();
                $('#ward_id').html('<option value="">Đang tải xã...</option>');

                if (districtId) {
                    $.ajax({
                        url: `http://127.0.0.1:8002/api/wards/${districtId}`, // Sử dụng URL động
                        method: 'GET',
                        success: function(response) {
                            $('#ward_id').html('<option value="">Chọn xã</option>');
                            if (response.length > 0) {
                                response.forEach(function(ward) {
                                    $('#ward_id').append(
                                        `<option value="${ward.id}">${ward.name}</option>`
                                    );
                                });
                            } else {
                                $('#ward_id').html('<option value="">Không có xã</option>');
                            }
                        },
                        error: function() {
                            alert('Không thể tải danh sách xã.');
                        }
                    });
                } else {
                    $('#ward_id').html('<option value="">Chọn xã</option>');
                }
            });
            $('#create_address').submit(function(e) {
                e.preventDefault(); // Ngăn chặn hành động submit mặc định

                // Lấy giá trị từ các field
                const userId = $('input[name="user_id"]').val();
                const details = $('input[name="details"]').val();
                const address = $('input[name="address"]').val();
                const province = $('#province_id option:selected').text();
                const district = $('#district_id option:selected').text();
                const ward = $('#ward_id option:selected').text();

                const fullAddress = `${address}, ${ward}, ${district}, ${province}`;

                console.log(`Full Address: ${fullAddress}`);

                $.ajax({
                    url: "{{ route('partner.address.store') }}", // URL đến server
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        user_id: userId,
                        details: details,
                        address: fullAddress
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: response.message,
                            });

                            window.location.href = "{{ route('partner.address.index') }}";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Không thành công vui lòng thử lại sau!',
                            });
                        }
                    },
                    error: function(xhr) {
                        alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                        console.error(xhr.responseText);
                    }
                });
            });




        });
    </script>
@endpush
