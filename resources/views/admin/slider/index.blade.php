@extends('admin.layouts.master')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="content">
    <div class="container-xxl">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h3 class="title-5 m-b-35">Quản lý Slide</h3>
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <form action="{{ route('admin.slider.index') }}" method="get">
                        @csrf
                        <div class="rs-select2--light rs-select2--md">
                            <form action="{{ route('admin.slider.index') }}" method="GET">
                                <select class="js-select2" name="filter" onchange="this.form.submit()">
                                    <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Tất cả</option>
                                    <option value="main" {{ request('filter') == 'main' ? 'selected' : '' }}>Banner chính</option>
                                    <option value="advertisement" {{ request('filter') == 'advertisement' ? 'selected' : '' }}>Banner quảng cáo</option>
                                    <option value="intro" {{ request('filter') == 'intro' ? 'selected' : '' }}>Banner giới thiệu</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </form>
                        </div>
                        
                       
                    </form>
                </div>
                <div class="table-data__tool-left">
                    <form class="au-form-icon" action="{{ route('admin.slider.index') }}" method="GET">
                        <input class="au-input--w300 au-input--style2" name="search" value="{{ request('search') }}" type="text"
                            placeholder="Tìm kiếm &amp; ..." />
                        <input type="hidden" name="filter" value="{{ request('filter') }}"> <!-- Giữ trạng thái bộ lọc -->
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                    
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('admin.slider.create') }}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>Thêm Slider</button></a>

                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên Banner</th>
                            <th>Hình ảnh</th>
                            <th>Loại Banner</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listBanner as $item)
                            <tr class="tr-shadow">                          
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                                    <img src="{{ \Storage::url($item->image) }}" alt="Banner Image" width="150px">
                                </td>
                                <td>
                                    @if ($item->type == 'main')
                                        <span class="text-primary">Banner Chính</span>
                                    @elseif ($item->type == 'intro')
                                        <span class="text-info">Banner Giới Thiệu</span>
                                    @else
                                        <span class="text-warning">Banner Quảng Cáo</span>
                                    @endif
                                </td>
                                <td><span class="{{ $item->status == 'Hiển thị' ? 'text-success' : 'text-danger' }}">
                                    {{$item->status}}
                                </span></td>
                                <td>
                                    <div class="table-data-feature d-flex align-items-center">
                                        <a href="{{ route('admin.slider.edit', $item->id) }}" class="mr-1">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.slider.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa không')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    @if ($listBanner->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($listBanner->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true"
                                        aria-label="@lang('pagination.previous')">
                                        <span class="page-link" aria-hidden="true">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $listBanner->previousPageUrl() }}"
                                            rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($listBanner->links()->elements as $element)
                                    {{-- "Three Dots" Separator --}}
                                    @if (is_string($element))
                                        <li class="page-item disabled" aria-disabled="true"><span
                                                class="page-link">{{ $element }}</span></li>
                                    @endif

                                    {{-- Array Of Links --}}
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $listBanner->currentPage())
                                                <li class="page-item active" aria-current="page"><span
                                                        class="page-link">{{ $page }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($listBanner->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $listBanner->nextPageUrl() }}" rel="next"
                                            aria-label="@lang('pagination.next')">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true"
                                        aria-label="@lang('pagination.next')">
                                        <span class="page-link" aria-hidden="true">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
    function fetchBanners() {
        let filter = $('#filter').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.slider.index') }}",
            method: "GET",
            data: {
                filter: filter,
                search: search
            },
            success: function (response) {
                $('#bannerTable').html(response.html); // Cập nhật nội dung bảng
            },
            error: function () {
                alert("Đã xảy ra lỗi khi tải dữ liệu.");
            }
        });
    }

    // Lọc khi thay đổi bộ lọc
    $('#filter').change(function () {
        fetchBanners();
    });

    // Tìm kiếm khi nhập vào ô tìm kiếm
    $('#search').on('input', function () {
        fetchBanners();
    });
});

    </script>
@endsection