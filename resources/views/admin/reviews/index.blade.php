@extends('admin.layouts.master')

@section('title')
    Quản lý đánh giá
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Đánh giá</h3>
                <div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>

                <!-- Hiển thị thông báo lỗi nếu có -->
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="au-breadcrumb-content">
                    <!-- Lọc theo ngày -->
                    <form action="{{ route('admin.reviews.index') }}" method="GET" class="au-form-icon--sm">
                        @csrf
                        <label for="">Ngày bắt đầu</label>
                        <input class="au-input--w300 au-input--style2" type="date" name="start_date"
                            placeholder="Ngày bắt đầu" value="{{ request('start_date') }}">
                        <label for="">Ngày kết thúc</label>
                        <input class="au-input--w300 au-input--style2" type="date" name="end_date"
                            placeholder="Ngày kết thúc" value="{{ request('end_date') }}">


                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="rating">
                                <option value="">Chọn số sao</option>
                                <option value="1" {{ request('rating') == 1 ? 'selected' : '' }}>1 sao</option>
                                <option value="2" {{ request('rating') == 2 ? 'selected' : '' }}>2 sao</option>
                                <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>3 sao</option>
                                <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>4 sao</option>
                                <option value="5" {{ request('rating') == 5 ? 'selected' : '' }}>5 sao</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter" type="submit"><i class="zmdi zmdi-filter-list"></i> Lọc</button>
                    </form>
                </div>
                <br>
                <div class="table-data__tool-right">
                    <a href="{{ route('admin.reviews.index') }}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small mr-2">
                           hiển thị tất cả
                        </button>
                    </a>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" id="reviews-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Người dùng</th>
                                <th>Sản phẩm</th>
                                <th>Nội dung</th>
                                <th>Sao</th>
                                <th>Ngày</th>
                                <th>Cảnh báo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <style>
                                    .checked {
                                        color: orange;
                                    }
                                </style>
                                <tr id="review-{{ $review->id }}">
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->user->name }}</td>
                                    <td>{{ $review->product->name }}</td>
                                    <td>{{ $review->review }}</td>
                                    <td>
                                        <!-- Hiển thị sao bằng Font Awesome -->
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="fa fa-star {{ $i <= $review->rating ? 'checked' : '' }}"></span>
                                        @endfor
                                    </td>
                                    <td>{{ $review->created_at->format('Y-m-d') }}</td>
                                    <td class="review-status">
                                        @if ($review->rating < 3)
                                            <span class="badge badge-danger">Sao thấp</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Nút Xóa -->
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $reviews->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
