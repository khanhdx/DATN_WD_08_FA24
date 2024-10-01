@extends('admin.admin')

@section('css')
@endsection


@section('content')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35 ">Thêm sản phẩm</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr class="tr-shadow">

                                    <div class="table-data__tool-right mb-3">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <a href="{{ route('admin.products.index')}}">Quay lại danh sách</a>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Tên sản phẩm:</label>
                                            <input class="au-input au-input--full" type="text" name="name"
                                                placeholder="Tên sản phẩm">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group ">
                                                    <label for="category">Danh mục:</label>
                                                    <select name="category_id" id="category" class="form-control">
                                                        <option>--- Chọn Danh mục ---</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Mã sản phẩm:</label>
                                                    <input class="au-input au-input--full" type="text" name="SKU"
                                                        placeholder="Tên sản phẩm">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title">Giá gốc:</label>
                                                    <input class="au-input au-input--full" type="text" name="price_regular"
                                                        placeholder="Nhập giá góc">
                                                </div>
                                                <div class="form-group">
                                                    <label for="author">Giá khuyến mãi:</label>
                                                    <input class="au-input au-input--full" type="text" name="price_sale"
                                                        placeholder="Nhập giá khuyến mãi">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Ảnh sản phẩm:</label>
                                            <input class="au-input au-input--full" type="file" name="image"
                                                placeholder="Tên sản phẩm">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Mổ tả ngắn:</label>
                                            {{-- <input class="au-input au-input--full" type="text" name="content" placeholder="Nội dung" > --}}
                                            <textarea class="au-input au-input--full" name="description" placeholder="Mô tả ngắt"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Mô tả chi tiết</label>
                                            {{-- <input class="au-input au-input--full" type="text" name="content" placeholder="Nội dung" > --}}
                                            <textarea class="au-input au-input--full" name="content" placeholder="Nội dung"></textarea>
                                        </div>

                                        <div class="table-data__tool-right">
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Thêm sản phẩm
                                            </button>
                                        </div>

                                        {{-- 
                                            // Xử lý thêm biến thể đồng thời thêm sản phẩm mới
                                            div class="table-data__tool-right">
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Thêm sản phẩm
                                            </button>
                                        </div>
                                        --}}
                                    </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- END DATA TABLE-->
@endsection

@section('js')
    <script>
        // Mở popup
        function openPopup() {
            document.getElementById('popupOverlay').style.display = 'flex';
        }

        // Đóng popup khi nhấn vào bên ngoài popup hoặc nút đóng
        function closePopup(event) {
            const popupContent = document.querySelector('.popup-content');
            if (!event || event.target !== popupContent) {
                document.getElementById('popupOverlay').style.display = 'none';
            }
        }

        let variantIndex = 1;

        function addVariant() {
            const variantsDiv = document.getElementById('variants');
            const newVariant = document.createElement('div');
            newVariant.classList.add('variant-group');

            newVariant.innerHTML = `
                <label for="color">Màu sắc:</label>
                <input type="text" name="variants[${variantIndex}][color]" placeholder="Nhập màu sắc" >

                <label for="size">Kích thước:</label>
                <input type="text" name="variants[${variantIndex}][size]" placeholder="Nhập kích thước" >

                <label for="stock">Số lượng:</label>
                <input type="number" name="variants[${variantIndex}][stock]" placeholder="Nhập số lượng" >

                <button type="button" class="remove-button" onclick="removeVariant(this)">Xóa biến thể</button>
            `;

            variantsDiv.appendChild(newVariant);
            variantIndex++;
        }

        function removeVariant(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
