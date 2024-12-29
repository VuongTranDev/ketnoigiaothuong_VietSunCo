@extends('frontend.partner.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lĩnh vực của công ty</h1>
        </div>
        <div class="mb-3">
            <a href="{{ route('partner.company.index') }}" class="btn btn-primary">Trở về</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Những lĩnh vực hiện có của công ty:</h4>
                            @foreach ($categories as $cate)
                                @if ($companyCategory->contains('id', $cate->id))
                                    <form action="{{ route('partner.company.category.delete') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="cate_id" value="{{ $cate->id }}">
                                        <span style="margin-right:10px" class="badge bg-light text-dark rounded-pill">
                                            {{ $cate->name }}
                                            <button type="submit" class="btn btn-link p-0 text-dark" style="font-size: 14px; margin-left: 5px; display: inline;" aria-label="Remove" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'">
                                                <i style="margin-bottom:10px" class="fas fa-times"></i> <!-- Biểu tượng dấu X -->
                                            </button>

                                        </span>

                                    </form>

                                @endif
                            @endforeach
                        </div>
                        <div class="card-body">
                            <form action="{{ route('partner.company.category.store') }}" method="POST">
                                @csrf
                                <div class="input-group">

                                    <select class="form-control main-category " name="cate_id" required>

                                        <option value="" disabled selected>Chọn Lĩnh vực</option>
                                        @foreach ($categories as $cate)
                                            @if (!$companyCategory->contains('id', $cate->id))
                                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p style="margin: 0 10px;"></p>

                                    <button type="submit" class="btn btn-primary rounded-pill text-white">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </section>
@endsection
