<!-- Begin Search -->
<div class="modal fade bs-example-modal-lg search-wrapper" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <p class="clearfix"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Đóng</span></button></p>
            <form class="form-inline form-search" role="form" action="{{ route('products.SearchPro') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label class="sr-only" for="textsearch">Nhập tìm kiếm</label>
                    <input type="text" class="form-control input-lg" id="textsearch" name="query" placeholder="Nhập tìm kiếm" required>
                </div>
                <button type="submit" class="btn btn-white">Tìm kiếm</button>
            </form>
        </div>
    </div>
</div>
<!-- End Search -->