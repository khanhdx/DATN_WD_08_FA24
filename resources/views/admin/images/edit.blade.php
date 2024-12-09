<!-- Modal Update -->
<div class="modal fade updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateModalLabel">
                    <span class="imageProductName">Chỉnh sửa ảnh: </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-images" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" name="product_id" value="" id="product-id">
                    <input type="hidden" name="image_id" value="" id="image-id">
                    <div class="form-group">
                        <label for="image_main">Chỉnh sửa ảnh chính:</label><br>
                        <img src="" alt="" class="image-main mb-2 img-main" width="120">
                        <input class="form-control" type="file" name="image_main" id="image_main">
                    </div>

                    <div class="form-group" id="imageOthers">
                        <label for="image_others">Chỉnh sửa ảnh phụ:</label>
                        <div class="image-others">
                            
                        </div>
                        <input class="form-control" type="file" name="image_others[]" id="image_others" multiple>

                    </div>

                    <button type="button" class="btn btn-success mr-1" id="create-image-others">Thêm ảnh phụ</button>
                    <button type="submit" class="btn btn-primary mr-1">Chỉnh sửa</button>
                    <button type="button" class="btn btn-danger mr-1" id="delete-images">
                        Xóa ảnh phụ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
