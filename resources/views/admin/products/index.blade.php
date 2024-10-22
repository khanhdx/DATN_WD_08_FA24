@extends('admin.layouts.master')

@section('css')
    <style>
        .modal {
            display: none;
            /* Ẩn modal mặc định */
            position: fixed;
            /* Cố định vị trí modal trên màn hình */
            z-index: 1;
            /* Đưa modal lên trên cùng */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Màu nền mờ */
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            /* Đặt modal ở giữa */
            padding: 20px;
            border-radius: 5px;
            width: 80%;
        }

        .close {
            color: red;
            float: right;
            font-size: 28px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (request()->input('keyword'))
                    <h2 class="title-5 m-b-35 mt-3">Kết quả tìm kiếm cho: "{{ request()->input('keyword') }}"</h2>
                    </h2>
                @else
                    <h2 class="title-5 m-b-35 mt-3">Sản phẩm</h2>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-data__tool">
                    <form action="{{ route('admin.products.filter') }}" method="get">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="category_id">
                                    <option selected="selected">Danh mục</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" id="openFilterBtn" class="btn btn-primary">
                                Mở bộ lọc thêm
                            </button>
                            <button type="submit" class="au-btn-filter" id="au-btn-filter">
                                <i class="zmdi zmdi-filter-list"></i>Lọc</button>
                        </div>
                    </form>

                    <div id="filterModal" class="modal" style="display: none;">
                        <div class="modal-content">
                            <span class="close" id="closeModalBtn">&times;</span>
                            <h2>Lọc sản phẩm</h2>

                            <!-- Các bộ lọc thêm -->
                            <form action="{{ route('admin.products.filter') }}" method="get">
                                <!-- Lọc theo khoảng giá -->
                                <label for="price_min">Giá từ:</label>
                                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min">

                                <label for="price_max">Đến:</label>
                                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max">

                                <!-- Lọc theo kích thước -->
                                <label for="size">Kích thước:</label>
                                <select name="size">
                                    <option value="">Tất cả</option>
                                    <option value="S" {{ request('size') == 'S' ? 'selected' : '' }}>S</option>
                                    <option value="M" {{ request('size') == 'M' ? 'selected' : '' }}>M</option>
                                    <option value="L" {{ request('size') == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="XL" {{ request('size') == 'XL' ? 'selected' : '' }}>XL</option>
                                </select>

                                <!-- Lọc theo màu sắc -->
                                <label for="color">Màu sắc:</label>
                                <select name="color">
                                    <option value="">Tất cả</option>
                                    <option value="Red" {{ request('color') == 'Red' ? 'selected' : '' }}>Đỏ
                                    </option>
                                    <option value="Blue" {{ request('color') == 'Blue' ? 'selected' : '' }}>Xanh
                                    </option>
                                    <option value="Green" {{ request('color') == 'Green' ? 'selected' : '' }}>Xanh lá
                                    </option>
                                    <option value="Black" {{ request('color') == 'Black' ? 'selected' : '' }}>Đen
                                    </option>
                                    <option value="White" {{ request('color') == 'White' ? 'selected' : '' }}>Trắng
                                    </option>
                                </select>
                                <button type="submit" class="btn btn-primary">Áp dụng</button>
                            </form>
                        </div>
                    </div>

                    <form class="au-form-icon" action="{{ route('admin.products.index') }}" method="GET">
                        <input class="au-input--w300 au-input--style2" name="keyword"
                            value="{{ request()->input('keyword') }}" type="text" placeholder="Tìm kiếm..." />
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin.products.create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Thêm</button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    @if ($products->isEmpty())
                        <p>Không tìm thấy sản phẩm </p>
                    @else
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Danh mục</th>
                                    <th>SKU</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Giá khuyến mãi</th>
                                    <th>Lượt xem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $item['id'] }}</td>
                                        <td>
                                            <img src="{{ Storage::url($item->image) }}" alt="" width="100px">
                                        </td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->SKU }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="desc">{{ $item->price_regular }}</td>
                                        <td class="desc">{{ $item->price_sale }}</td>
                                        <td>{{ $item->views }}</td>

                                        <td>
                                            <div class="table-data-feature">

                                                {{-- Thêm biến thể  --}}
                                                <a href="{{ route('admin.products.variants.create', $item->id) }}">
                                                    <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                        title="Thêm biến thể">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button></a>

                                                {{-- Xem chi tiết  --}}
                                                <a href="{{ route('admin.products.edit', $item->id) }}">
                                                    <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                        title="Xem chi tiết sản phẩm">
                                                        <i class="fas fa-eye"></i>
                                                    </button></a>

                                                {{-- Sửa sản phẩm --}}
                                                <a href="{{ route('admin.products.edit', $item->id) }}">
                                                    <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button></a>

                                                {{-- Xóa sản phẩm  --}}
                                                <form action="{{ route('admin.products.delete', $item->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("filterModal");
            var openFilterBtn = document.getElementById("openFilterBtn");
            var closeModalBtn = document.getElementById("closeModalBtn");

            // Mở modal khi nhấn nút
            openFilterBtn.onclick = function() {
                modal.style.display = "block";
            };

            // Đóng modal khi nhấn nút "X"
            closeModalBtn.onclick = function() {
                modal.style.display = "none";
            };

            // Đóng modal khi nhấn ngoài vùng modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        });

        
    </script>
@endsection
