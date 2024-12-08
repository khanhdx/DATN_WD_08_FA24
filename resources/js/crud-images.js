import './bootstrap';

const API_IMAGES = '/api/images';
const tableBody = document.getElementById("imagesTableTbody");
const formCreate = document.getElementById("create-images");
const formUpdate = document.getElementById("update-images");
const buttonDelete = document.getElementById('delete-images');
let selectedImg = [];

let currentPage = 1;
let imageId = 0;
let productId = 0;

$(document).ready(function () {
    $("#mySearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#imagesTableTbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

// Nút create ảnh mới
formCreate.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    axios.post(API_IMAGES, formData)
        .then((response) => {
            formCreate.reset();
            $('#createModal').modal('hide');
            fetchData();

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
                html: `<span class="text-center">${response.data.message}</span>`,
            });
        }).catch((error) => {
            console.log('Error: ', error);
        })
});

// Nút xóa toàn bộ ảnh
$(document).on('click', '.show-delete', function () {
    const id = $(this).data('id');
    const data = {
        _method: "DELETE"
    }

    Swal.fire({
        title: "Bạn có chắc muốn xóa toàn bộ ảnh này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Có!"

    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(`${API_IMAGES}/${id}`, data)
                .then((response) => {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success"
                    });
                    fetchData();

                }).catch((error) => {
                    console.log('Error: ', error);
                })
        }
    });

});

// Hiển thị Modal Update
$(document).on('click', '.show-update', function () {
    imageId = $(this).data('id');
    $('#image-others').empty();
    $('.imageProductName').text("Cập nhật ảnh: ");
    $('#product-id').empty();
    selectedImg = [];
    buttonDelete.disabled = true;

    axios.get(`${API_IMAGES}/${imageId}`)
        .then((response) => {
            const image = response.data.data.image;
            const imageOthers = response.data.data.image_others;
            productId = image.product.id;

            $('.imageProductName').text(`Cập nhật ảnh: ${image.product.name}`);
            $('#image-main').attr('src', `/storage/${image.image_url}`);

            imageOthers.forEach((item) => {
                const imgURL = `/storage/${item.image_url}`;
                $('#image-others').append(/* html */`
                        <a href="#" data-id="${item.id}" class="select-img mr-2 mt-2">
                            <img src="${imgURL}" alt="Image" width="60">
                        </a>
                    `
                );
            });

        }).catch((error) => {
            console.log('Error: ', error);
        });
});

// Chọn nhiều ảnh để cập nhật
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
    buttonDelete.disabled = false;

    console.log("Selected Images:", selectedImg);
});

$('#delete-images').click(function (e) {
    const data = {
        _method: "DELETE",
        images_id: JSON.stringify(selectedImg),
    }

    Swal.fire({
        title: "Bạn có chắc muốn xóa ảnh phụ này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Có!"

    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(`/api/delete-image`, data)
                .then((response) => {
                    formUpdate.reset();
                    $('.updateModal').modal('hide');
                    fetchData();

                    Swal.fire({
                        title: response.data.message,
                        icon: "success"
                    });
                }).catch((error) => {
                    console.log('Error: ', error);
                });
        }
    });

})

// Nút cập nhật ảnh
$(document).on('submit', '#update-images', function (e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    formData.append('images_id', JSON.stringify(selectedImg));
    formData.append('product_id', productId);

    // for (const item of formData) {
    //     console.log(item[0], item[1]);
    // }

    axios.post(`${API_IMAGES}/${imageId}`, formData)
        .then((response) => {
            formUpdate.reset();
            $('.updateModal').modal('hide');
            fetchData();

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
                html: `<span class="text-center">${response.data.message}</span>`,
            });

        }).catch((error) => {
            Swal.fire({
                icon: "error",
                title: "Có lỗi...",
                html: `
                    <span>
                        ${error.response.data.message}
                    </span>
                `,
            });
            console.log('Error: ', error.response?.data || error.message);
        })
});



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
                <img src="${imgURL}" alt="Image" width="60">
            </td>
            <td>
                <div class="table-data-feature">
                    <button class="item show-update" type="button" title="Cập Nhật"
                        data-toggle="modal" data-target=".updateModal" data-id="${item.id}">
                        <i class="zmdi zmdi-edit"></i>
                    </button>

                    <button class="item show-delete" type="button" title="Xóa" data-id="${item.id}">
                        <i class="zmdi zmdi-delete"></i>
                    </button>

                    <button class="item" title="Xem chi tiết">
                        <i class="zmdi zmdi-more"></i>
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