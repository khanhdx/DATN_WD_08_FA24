<style>
    .ipPass {
        position: relative;
        display: flex;
    }
    #showPassword {
        position: absolute;
        text-align: center;
        height: 100%;
        margin-left: 95%;
    }
    .imgPr {
        border-left: .0625rem solid #efefef;
        overflow: hidden;
        width: 100%;
    }
    .ImttOn {
        flex-direction: column;
        align-items: center;
        display: flex;
    }
    .imgTT {
        height: 6.25rem;
        margin: 1.25rem 0;
        position: relative;
        width: 6.25rem;
        justify-content: center;
        align-items: center;
        display: flex;
    }
    .choseFile {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .09);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .03);
        color: #555;
        outline: 0;
        overflow: visible;
        position: relative;
        height: 40px;
        max-width: 220px;
        min-width: 70px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        flex-direction: column;
        font-size: 14px;
        justify-content: center;
        cursor: pointer;
    }
    .imgT {
        background-position: 50%;
        background-repeat: no-repeat;
        background-size: cover;
        cursor: pointer;
        height: 100%;
        width: 100%;
        border-radius: 50%; 
    }
</style>
<form id="formEdit" class="row g-3 needs-validation" action="{{ route('admin.project.update',Auth::user()->id) }}" method="POST" novalidate>
    @csrf
    @method('PUT')
    <div class="col-8">
        <div class="col-md-12 mb-3">
            <label for="validationCustom01" class="form-label">Tên tài khoản</label>
            <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Họ & tên" value="{{ Auth::user()->name }}" required>
            <div class="errors validationName invalid-feedback">
                Không thể trống
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationCustom02" class="form-label">Email đăng nhập</label>
            <input type="text" class="form-control" id="validationCustom02" name="email" placeholder="abc@gmail.com" value="{{ Auth::user()->email }}" required>
            <div class="errors validationEmail invalid-feedback">
                Không thể trống
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label for="phone_number" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="+000 000 000" value="{{ Auth::user()->phone_number }}">
            <div class="errors validationPhone invalid-feedback">
            </div>
        </div>
        {{-- <div class="col-md-12 mb-3">
            <label for="validationCustom03" class="form-label">Mật khẩu</label>
            <div class="ipPass">
                <input type="password" class="form-control" id="validationCustom03" placeholder="********" value="{{ bcrypt(Auth::user()->password) }}" required>
                <button id="showPassword"><i class="fa-regular fa-eye-slash"></i></button>
            </div>
            <div class="errors validationPassword invalid-feedback">
                Không thể bỏ trống.
            </div>
        </div> --}}
    </div>
    <div class="col-4">
        <div class="imgPr">
            <div class="ImttOn">
                <div class="imgTT">
                    @if (Auth::user()->user_image)
                        <div class="imgT" id="imgPreview"><img src="{{ asset('storage/' . Auth::user()->user_image) }}" style="width: 100%;height: 100%;object-fit: cover;border-radius:50%;border: 1px solid silver;" alt=""></div>
                    @else
                        <div class="imgT" id="imgPreview" style="background-image: url({{ asset('assets/admin/images/icon/avatar-01.jpg') }});"></div>
                    @endif
                    <input class="d-none" style="display: none;" type="file" name="user_image" id="user_image">
                </div>
                <label for="user_image" class="choseFile">Chọn Ảnh</label>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="buttons d-flex justify-content-end">
            <button type="button" class="w-25 bootbox-close-button btn btn-secondary ml-3 px-3">Hủy</button>
            <button type="submit" class="w-25 btn btn-success ml-3 px-3">Lưu</button>
        </div>
    </div>
</form>
<script>
    (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    })
    })()

    const imageInput = document.getElementById('user_image');
    const previewImage = document.getElementById('imgPreview');

    imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
        previewImage.style.backgroundImage = `url(${e.target.result})`;
        };
        reader.readAsDataURL(file);
    } else {
        previewImage.style.backgroundImage = 'none';
    }
    });
</script>