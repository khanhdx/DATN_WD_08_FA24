import axios from 'axios';
import './bootstrap';

const API_IMAGES = '/api/images';
const API_PRODUCT_IMG = '/api/product/image';
const tableBody = document.getElementById("imagesTableTbody");
const formCreate = document.getElementById("create-images");
const formUpdate = document.getElementById("update-images");

let selectedImg = [];
let currentPage = 1;

// Hàm lấy dữ liệu từ ID
const getImageById = (imageId, text = "", className = "") => {
    axios.get(`${API_IMAGES}/${imageId}`)
        .then((response) => {
            const image = response.data.data.image;
            const imageOthers = response.data.data.image_others;

            $('#product-id').val(image.product.id);
            $('#image-id').val(image.id)
            $('.imageProductName').text(`${text + image.product.name}`);
            $('.image-main').attr('src', `/storage/${image.image_url}`);

            imageOthers.forEach((item) => {
                const imgURL = `/storage/${item.image_url}`;
                $('.image-others').append(`
                    <a href="#" data-id="${item.id}" class="${className} m-1 mb-2">
                        <img src="${imgURL}" alt="Image" width="60">
                    </a>
                `
                );
            });

        }).catch((error) => {
            console.log('Error: ', error);
        });
}

// Hàm Delete ảnh
const deleteOneOrMany = (data, urlAPI, text = "") => {
    Swal.fire({
        title: `${text}`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Có!"

    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(urlAPI, data)
                .then((response) => {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success"
                    });
                    $('.updateModal').modal('hide');
                    fetchData();

                }).catch((error) => {
                    alertFailed(error.response.data.message);
                    console.log('Error: ', error);
                })
        }
    });
}

// Nút Create ảnh mới
formCreate.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    axios.post(API_IMAGES, formData)
        .then((response) => {
            formCreate.reset();
            $('#createModal').modal('hide');
            fetchData();

            alertSuccess(response.data.message)
        }).catch((error) => {
            let text  = error.response.data.message;
            let result = text.replace(/[()]|\d|\band\b|\bmore\b|\berror\b|\berrors\b/g, "");
            
            alertFailed(result);
        });
});

// Nút Create ảnh phụ
$(document).on('click', '#create-image-others', function () {

    const formData = new FormData(formUpdate);

    formData.delete('_method');
    formData.delete('image_id');
    formData.delete('image_main');

    axios.post('/api/image-others', formData)
        .then((response) => {
            $('.updateModal').modal('hide');

            formUpdate.reset();

            fetchData();

            alertSuccess(response.data.message);
        })
        .catch((error) => {
            alertFailed(error.response.data.message);
            console.log(error);
        });
});

// Nút hiển thị Form Update
$(document).on('click', '.show-update', function () {
    const dataImageId = $(this).data('id');
    $('.image-others').empty();
    selectedImg = [];

    getImageById(dataImageId, 'Chỉnh sửa ảnh: ', 'select-img');
});

// Chọn ảnh phụ
$(document).on('click', '.select-img', function (e) {
    e.preventDefault();
    $(this).toggleClass('img-active');

    const imgId = $(this).data('id');
    const index = selectedImg.findIndex(img => img.id === imgId);

    if (index > -1) {
        selectedImg.splice(index, 1);
    } else {
        selectedImg.push({ id: imgId });
    }

    console.log("Selected Images:", selectedImg);
});

// Nút Delete ảnh phụ
$(document).on('click', '#delete-images', function () {
    const data = {
        _method: "DELETE",
        images_id: JSON.stringify(selectedImg),
    }
    const text = "Bạn có chắc muốn xóa ảnh phụ này?";

    deleteOneOrMany(data, '/api/image-others', text);
})

// Nút Update ảnh
$(document).on('submit', '#update-images', function (e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    const imageId = $('#image-id').val();

    formData.append('images_id', JSON.stringify(selectedImg));

    axios.post(`${API_IMAGES}/${imageId}`, formData)
        .then((response) => {
            $('.updateModal').modal('hide');

            formUpdate.reset();

            fetchData();

            alertSuccess(response.data.message);
        }).catch((error) => {
            alertFailed(error.response.data.message);
        });
});

// Nút Delete toàn bộ ảnh
$(document).on('click', '.button-delete', function () {
    const id = $(this).data('id');
    const data = {
        _method: "DELETE"
    }
    deleteOneOrMany(data, `${API_IMAGES}/${id}`, "Bạn có chắc muốn xóa toàn bộ chỗ ảnh này?");
});

// Thanh Search tìm theo tên sản phẩm hoặc ID
$(document).ready(function () {
    $("#mySearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();    
        $("#imagesTableTbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

// Nút thêm dữ liệu product có liên kết đến product_image
// $('#create-form').click(function () {
//     $('#product-name').children(':not(:first-child)').remove();

//     axios.get(API_PRODUCT_IMG)
//         .then((response) => {
//             const data = response.data.data;
//             if (data.length === 0) {
//                 $('#product-name').append(`<option selected>Hiện tại không còn sản phẩm</option>`);
//             } else {
//                 data.forEach((item) => {
//                     $('#product-name').append(`
//                         <option value="${item.id}">${item.name}</option>
//                     `
//                     );
//                 });
//             }

//         }).catch((error) => {
//             console.log(error)
//         })
// })

// Hàm thông báo thành công
const alertSuccess = (text) => {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        html: `<span class="text-center">${text}</span>`,
    });
}

// Hàm thông báo lỗi
const alertFailed = (text) => {
    Swal.fire({
        icon: "error",
        title: "Có lỗi...",
        html: `
            <span>${text}</span>
        `,
    });
}

// Hàm tải dữ liệu
const fetchData = (page = 1) => {
    axios.get(`${API_IMAGES}?page=${page}`)
        .then(response => {
            const data = response.data;
            currentPage = data.current_page;
            renderTable(data.data); // Hiển thị dữ liệu
            renderPagination(data); // Hiển thị nút phân trang
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
};

// Hàm hiển thị dữ liệu lên bảng
const renderTable = (items) => {
    tableBody.innerHTML = '';

    items.forEach((item) => {
        const imgURL = `/storage/${item.image_url}`;
        const row = /* html */ `
        <tr>
            <td>${item.id}</td>
            <td>${item.product.name}</td>
            <td>
                <img src="${imgURL}" alt="Image" width="60" class="img-main">
            </td>
            <td>
                <div class="table-data-feature">
                    <button class="item show-update" type="button" title="Cập Nhật"
                        data-toggle="modal" data-target=".updateModal" data-id="${item.id}">
                        <i class="zmdi zmdi-edit"></i>
                    </button>

                    <button class="item button-delete" type="button" title="Xóa" data-id="${item.id}">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                </div>
            </td>
        </tr>
        <tr class="spacer"></tr>
    `;
        tableBody.insertAdjacentHTML('beforeend', row);
    });
};

// Hàm hiển thị nút phân trang
const renderPagination = (pagination) => {
    const paginationDiv = document.querySelector('.pagination');
    paginationDiv.innerHTML = '';

    const ul = document.createElement('ul');
    ul.className = 'pagination justify-content-end';

    pagination.links.forEach(link => {
        const li = document.createElement('li');
        li.className = 'page-item ' + (link.active ? 'active' : '') + (link.url ? '' : 'disabled');

        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.innerHTML = link.label;

        if (link.url) {
            a.addEventListener('click', (e) => {
                e.preventDefault();
                fetchData(new URL(link.url).searchParams.get('page'));
            });
        }

        li.appendChild(a);
        ul.appendChild(li);
    });
    paginationDiv.appendChild(ul);
};

// Gọi hàm tải dữ liệu lần đầu tiên
fetchData();