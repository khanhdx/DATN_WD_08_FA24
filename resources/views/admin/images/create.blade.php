<!-- Modal Create-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createModalLabel">Thêm ảnh trưng bày</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-images" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product-name">Chọn sản phẩm cần ảnh</label>
                        <select class="form-control" name="product_id" id="product-name">
                            <option value="">Lựa chọn sản phẩm</option>
                           @foreach ($products as $item)
                               <option value="{{$item->id}}">{{ $item->name }}</option>
                           @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image_main">Chọn ảnh chính:</label>
                        <input class="form-control" type="file" name="image_main" id="image_main">
                    </div>

                    <div class="form-group">
                        <label for="image_others">Chọn ảnh phụ:</label>
                        <input class="form-control" type="file" name="image_others[]" id="image_others" multiple>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
