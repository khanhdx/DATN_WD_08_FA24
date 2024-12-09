@extends('admin.layouts.master')

@section('title')
    Quản lý ảnh trưng bày sản phẩm
@endsection

@section('css')
    <style>
        .modal-backdrop {
            z-index: -1;
        }
    </style>
@endsection

@section('content')
    @include('admin.images.create')
    @include('admin.images.edit')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h3 class="title-5 m-b-35">ảnh trưng bày sản phẩm</h3>
                <div class="table-data__tool">
                    <input class="au-input--w300 au-input--style2" name="keyword" id="mySearch"
                            value="" type="text" placeholder="Tìm kiếm..." />

                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="button" data-toggle="modal"
                            data-target="#createModal" id="create-form">
                            <i class="zmdi zmdi-plus"></i>Thêm
                        </button>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Ảnh chính</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="imagesTableTbody">
                            
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    <ul class="pagination justify-content-end"></ul>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection

@section('js')
    @vite('resources/js/crud-images.js')
@endsection
