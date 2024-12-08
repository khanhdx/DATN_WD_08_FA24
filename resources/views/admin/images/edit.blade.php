<!-- Modal Update -->
<div class="modal fade updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateModalLabel">
                    <span class="imageProductName">Cập nhật ảnh: </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-images" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    <div class="form-group">
                        <label for="image_main">Chọn ảnh chính:</label>
                        <img src="" alt="" id="image-main" width="60" class="mt-2">
                        <input class="form-control" type="file" name="image_main" id="image_main">
                    </div>

                    <div class="form-group" id="imageOthers">
                        <label for="image_others">Chọn ảnh phụ:</label>
                        <div id="image-others">
                            
                        </div>
                        <input class="form-control" type="file" name="image_others[]" id="image_others" multiple>

                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-danger" id="delete-images" disabled>Xóa ảnh phụ</button>
                </form>
            </div>
        </div>
    </div>
</div>
