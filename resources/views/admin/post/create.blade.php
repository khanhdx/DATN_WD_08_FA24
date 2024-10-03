@extends('admin.layouts.master');
@section('content')
    <!-- DATA TABLE-->

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Thêm bài đăng</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr class="tr-shadow">
                                    
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <a href="{{ route('admin.post.index') }}">Quay lại danh sách</a>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="image">Ảnh:</label>
                                            <input class="au-input au-input--full" type="file" name="image" accept="image/*" placeholder="Ảnh" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Tiêu đề:</label>
                                            <input class="au-input au-input--full" type="text" name="title" placeholder="Tiêu đề" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="content">Nội dung:</label>
                                            {{-- <input class="au-input au-input--full" type="text" name="content" placeholder="Nội dung" required> --}}
                                            <textarea class="au-input au-input--full" name="content" placeholder="Nội dung" required></textarea>
                                        </div>
                            
                                        <div class="form-group">
                                            <label for="author">Tác giả:</label>
                                            <input class="au-input au-input--full" type="text" name="author" placeholder="Tác giả" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="publish_date">Ngày đăng:</label>
                                            <input class="au-input au-input--full" type="date" name="publish_date" placeholder="Ngày đăng" required>
                                        </div>
                                
                                        <div class="table-data__tool-right">
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Tạo bài viết
                                            </button>
                                        </div>
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
