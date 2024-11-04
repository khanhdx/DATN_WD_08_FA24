@extends('admin.layouts.master')
@section('title')
    Quản lý danh mục
@endsection
@section('content')
    <div class="content">   
        <div class="container">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Image:</label>
                                    <input type="file" id="image" name="image" class="form-control" onchange="showImage(event)">
                                    <img id="img_danh_muc" src="{{ url('storage/', $category->image) }}" alt="Hình ảnh danh mục" style="width: 150px;">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="ma_san_pham" class="form-label">Name:</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ $category->name }}" placeholder="Name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary justify-content-center">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> <!-- container-fluid -->
    </div>
@endsection

@section('js')
    <script>
        function showImage(event) {
            const img_danh_muc = document.getElementById('img_danh_muc');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_san_pham.src = reader.result;
                img_san_pham.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file)
            }
        }
    </script>
   
@endsection
