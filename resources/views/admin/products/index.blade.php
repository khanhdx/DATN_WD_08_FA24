@extends('admin.layouts.master')

@section('title')
    Quản lý sản phẩm
@endsection

@section('css')
    <style>
        .modal {
            display: none;
            position: fixed;/ z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);

        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
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
                                            {{ request('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button type="button" id="openFilterBtn" class="btn btn-primary">
                                Mở bộ lọc thêm
                            </button>
                            <button type="submit" class="au-btn-filter" id="au-btn-filter">
                                <i class="zmdi zmdi-filter-list"></i>Lọc</button>
                        </div>
                    </form>


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
                                    <th>Tên</th>
                                    <th>Tồn kho</th>
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
                                        <td>{{ $item->base_stock }}</td>
                                        <td class="desc">{{ number_format($item->price_regular, 0, ',', '.') }}</td>
                                        <td class="desc">{{ number_format($item->price_sale, 0, ',', '.') }}</td>
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
                    {{-- <div id="filterModal" class="modal" style="display: none;">
                        <div class="modal-content">

                            <!-- Các bộ lọc thêm -->
                            <form action="{{ route('admin.products.filter') }}" method="get">
                                <span class="close" id="closeModalBtn">&times;</span>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h2>Lọc sản phẩm</h2>
                                        </div>
                                        <div class="col-12 py-2 my-2">
                                            <h5 class="mb-3">Giá sản phẩm</h5>
                                            <div id="price-slider"></div>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label for="price-min" class="form-label">Giá
                                                        từ:</label>
                                                    <input type="number" name="price_min" id="price-min"
                                                        class="form-control" value="0" min="0"
                                                        max="{{ $maxPrice }}" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="price-max"class="form-label">Đến:</label>
                                                    <input type="number" name="price_max" id="price-max"
                                                        class="form-control" value="{{ $maxPrice }}" min="0"
                                                        max="{{ $maxPrice }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 py-2">
                                            <h5 class="mb-3">Ngày thêm sản phẩm</h5>
                                            <div id="price-slider"></div>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label for="start-date" class="form-label">Ngày bắt đầu:</label>
                                                    <input type="date" id="start-date" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="end-date" class="form-label">Ngày kết thúc:</label>
                                                    <input type="date" id="end-date" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 py-2 flex">
                                            <h5 class="mb-3">Trạng thái</h5>
                                            <div class="form-check">
                                                <input type="radio" id="all" name="status"
                                                    class="form-check-input" value="all" checked>
                                                <label for="all" class="form-check-label">Tất cả</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="active" name="status"
                                                    class="form-check-input" value="active">
                                                <label for="active" class="form-check-label">Đang hoạt động</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="inactive" name="status"
                                                    class="form-check-input" value="inactive">
                                                <label for="inactive" class="form-check-label">Ngừng hoạt động</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="pending" name="status"
                                                    class="form-check-input" value="pending">
                                                <label for="pending" class="form-check-label">Đang chờ xử lý</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                <button type="submit" id="apply-filter" class="btn btn-primary">Áp dụng</button>
                            </form>
                        </div>
                    </div> --}}

                    <div class="mt-2">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Ản-hiện popup lọc
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

        const maxPrice = Number(@json($maxPrice));

        // Khởi tạo thanh kéo noUiSlider
        var slider = document.getElementById('price-slider');
        noUiSlider.create(slider, {
            start: [0, maxPrice], // Giá trị bắt đầu cho khoảng giá
            connect: true,
            range: {
                'min': 0,
                'max': maxPrice,
            },
            step: 100000
        });

        // Cập nhật giá trị input khi người dùng di chuyển thanh kéo
        slider.noUiSlider.on('update', function(values, handle) {
            document.getElementById('price-min').value = Math.round(values[0]);
            document.getElementById('price-max').value = Math.round(values[1]);
        });

        // Cập nhật thanh kéo khi người dùng thay đổi giá trị input "Min"
        document.getElementById('price-min').addEventListener('change', function() {
            var minValue = Math.min(Math.max(this.value, 0), maxPrice);
            slider.noUiSlider.set([minValue, null]);
        });

        // Cập nhật thanh kéo khi người dùng thay đổi giá trị input "Max"
        document.getElementById('price-max').addEventListener('change', function() {
            var maxValue = Math.min(Math.max(this.value, 0), maxPrice);
            slider.noUiSlider.set([null, maxValue]);
        });

        document.getElementById('apply-filter').addEventListener('click', function() {
            const minPrice = document.getElementById('price-min').value;
            const maxPrice = document.getElementById('price-max').value;
        });
    </script>
@endsection
