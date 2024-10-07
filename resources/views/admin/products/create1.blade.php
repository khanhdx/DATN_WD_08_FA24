@extends('admin.layouts.master')

@section('css')
<style>
    body {
        font-family: Arial, sans-serif;
    }
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    input, textarea, select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
    button {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #218838;
    }
    .variant-group {
        border: 1px solid #ccc;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
    .remove-button {
        background-color: #dc3545;
        margin-top: 10px;
    }
    .remove-button:hover {
        background-color: #c82333;
    }
</style>

@endsection
    

@section('content')
    <form action="{{ route('admin.products.store')}}" method="POST">
        @csrf
        <!-- Thông tin sản phẩm -->
        <label for="name">Tên sản phẩm</label>
        <input type="text" id="name" name="name" placeholder="Nhập tên sản phẩm" required>

        <label for="description">Mô tả sản phẩm</label>
        <textarea id="description" name="description" placeholder="Nhập mô tả sản phẩm"></textarea>

        <label for="price">Giá sản phẩm</label>
        <input type="number" id="price" name="price" placeholder="Nhập giá sản phẩm" required>

        <!-- Biến thể sản phẩm -->
        <h3>Biến thể sản phẩm</h3>
        <div id="variants">
            <div class="variant-group">
                <label for="color">Màu sắc:</label>
                <input type="text" name="variants[0][color]" placeholder="Nhập màu sắc" required>

                <label for="size">Kích thước:</label>
                <input type="text" name="variants[0][size]" placeholder="Nhập kích thước" required>

                <label for="stock">Số lượng:</label>
                <input type="number" name="variants[0][stock]" placeholder="Nhập số lượng" required>

                <button type="button" class="remove-button" onclick="removeVariant(this)">Xóa biến thể</button>
            </div>
        </div>
        
        <button type="button" onclick="addVariant()">Thêm biến thể</button>
        <button type="submit">Thêm sản phẩm</button>
    </form>


@endsection

@section('js')
<script>
    let variantIndex = 1;

    function addVariant() {
        const variantsDiv = document.getElementById('variants');
        const newVariant = document.createElement('div');
        newVariant.classList.add('variant-group');

        newVariant.innerHTML = `
            <label for="color">Màu sắc:</label>
            <input type="text" name="variants[${variantIndex}][color]" placeholder="Nhập màu sắc" required>

            <label for="size">Kích thước:</label>
            <input type="text" name="variants[${variantIndex}][size]" placeholder="Nhập kích thước" required>

            <label for="stock">Số lượng:</label>
            <input type="number" name="variants[${variantIndex}][stock]" placeholder="Nhập số lượng" required>

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

