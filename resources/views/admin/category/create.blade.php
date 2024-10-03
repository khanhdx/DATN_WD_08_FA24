@extends('admin.layouts.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Name:</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Tên danh mục">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Image:</label>
                                    <input type="file" id="image" name="image" @error('image') is-invalid @enderror" class="form-control"
                                        onchange="showImage(event)">      
                                    <img id="img_danh_muc" src="" alt="Hình ảnh danh mục sản phẩm" style="width: 150px; display:none">
                                    @error('image')
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
                img_danh_muc.src = reader.result;
                img_danh_muc.style.display = 'block';
            }

            if(file){
                reader.readAsDataURL(file)
            }
        }
    </script>
@endsection

