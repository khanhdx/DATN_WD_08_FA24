@extends('client.layouts.master')

@section('title', 'Thanh Toán')
@section('text_page')
    Thanh Toán
@endsection
@section('css')
    <style>
        .modal-body {
            max-height: 540px;
            overflow-y: auto;
        }
        .voucher-label {
            cursor: pointer;
            transition: box-shadow 0.3s;
            padding:4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap:10px;
            border: 1px solid rgb(240, 240, 240);
        }

        .voucher-label:hover {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .voucher-label input[type="radio"]:checked + .voucher-label {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            /* Thêm các style khác để làm nổi bật khi chọn */
        }
    </style>
@endsection
@section('content')
    <div role="main" class="main">
        <!-- Thông báo lỗi -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <h4>Đặt hàng thành công!</h4>
                <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng.</p>
            </div>
        @endif

        @include('client.layouts.components.pagetop', ['md' => 'md'])

        <div class="container">
            <div id="loader" style="display: none;">
                <div class="loading-text">Đang xử lý dữ liệu
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="row featured-boxes">
                <div class="col-md-8">
                    <form id="form-order"
                        action="{{ auth()->check() ? route('checkout.process') : route('guest.checkout.process') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="ship_fee" id="input_ship_fee" value="0">
                        <input type="hidden" name="Vs_code" id="Vs_code" value="">{{-- Mã giảm giá --}}
                        <div class="featured-box featured-box-secondary featured-box-cart">
                            <div class="box-content">
                                <h4>Thông tin Thanh Toán</h4>
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputLN" class="col-sm-2 control-label">Họ và tên <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputLN" name="user_name"
                                                required value="{{ auth()->check() ? auth()->user()->name : old('user_name') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Địa Chỉ Email <span
                                                class="required">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="email"
                                                required
                                                value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">Số Điện Thoại
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="inputPhone" name="phone_number"
                                                required value="{{ auth()->user() ? auth()->user()->phone_number : old('phone_number') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputNote" class="col-sm-2 control-label">Ghi chú</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputNote" name="note" rows="3" placeholder="Nhập ghi chú nếu có">{{ old('note') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="province" class="control-label">
                                            Tỉnh / Thành phố <span class="required">*</span>
                                        </label>
                                        <select name="province" id="province" class="form-control" required>
                                            <option value="">Chọn Tỉnh / Thành phố</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district" class="control-label">Quận / Huyện <span
                                                class="required">*</span></label>
                                        <select name="district" id="district" class="form-control" required>
                                            <option value="">Chọn Quận / Huyện</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ward_street" class="control-label">Phường / Xã <span
                                                class="required">*</span></label>
                                        <select name="ward_street" id="ward_street" class="form-control" required>
                                            <option value="">Chọn Phường / Xã</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Số nhà, tên đường cụ thể</label>
                                        <input type="text" name="address" id="address" class="form-control" required
                                            value="{{ auth()->user() ? auth()->user()->address : old('address') }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <h4>Phương Thức Thanh Toán</h4>
                        <div class="panel-group panel-group2" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <label>
                                            <input type="radio" name="payment_method" value="COD" required>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseCOD">
                                                Thanh Toán Khi Nhận Hàng (COD)
                                            </a>
                                        </label>
                                    </h5>
                                </div>
                                <div id="collapseCOD" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Thanh toán bằng tiền mặt khi nhận hàng. Vui lòng chuẩn bị số tiền chính xác.</p>
                                    </div>
                                </div>
                            </div>
                            {{-- Thanh toan zaloPay chi dang nhap moi dung duoc --}}
                            @if (auth()->check())
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <label>
                                            <input type="radio" name="payment_method" value="zaloPay" required>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsezaloPay">Thanh
                                                Toán Qua zaloPay</a>
                                        </label>
                                    </h5>
                                </div>
                                <div id="collapsezaloPay" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Thanh toán qua zaloPay. Bạn sẽ được chuyển hướng tới trang zaloPay để thực hiện giao
                                            dịch.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <label>
                                            <input type="radio" name="payment_method" value="vnPay" required>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsevnPay">Thanh
                                                Toán Qua vnPay</a>
                                        </label>
                                    </h5>
                                </div>
                                <div id="collapsevnPay" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Thanh toán qua vnPay. Bạn sẽ được chuyển hướng tới trang vnPay để thực hiện giao
                                            dịch.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Đặt Hàng</button>
                        </p>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="featured-box featured-box-secondary sidebar">
                        <div class="box-content">
                            <h4>Đơn Hàng Của Bạn</h4>
                            <table cellspacing="0" class="cart-totals" width="100%">
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                        $quantityCart = 0;
                                        $discount = 0;//
                                    @endphp
                                    @foreach ($cartItems as $item)
                                        <tr class="cart_item">
                                            <th>
                                                @if (is_object($item) && $item->productVariant && $item->productVariant->product)
                                                    {{ $item->productVariant->product->name }} ({{ $item->quantity }})
                                                @elseif (is_array($item) && isset($item['productVariant']) && isset($item['productVariant']['product']))
                                                    {{ $item['productVariant']['product']['name'] }}
                                                    ({{ $item['quantity'] }})
                                                @else
                                                    {{ $item['name'] }}
                                                    ({{ isset($item['quantity']) ? $item['quantity'] : '0' }})
                                                @endif
                                            </th>
                                            <td class="product-price">
                                                <span
                                                    class="amount">{{ isset($item['sub_total']) ? number_format($item['sub_total'], 0, ',', '.') : '0' }} ₫</span>
                                            </td>
                                        </tr>
                                        @php
                                            $totalPrice += isset($item['sub_total']) ? $item['sub_total'] : 0;
                                            $quantityCart += isset($item['quantity']) ? $item['quantity'] : 0;
                                            // $quantityCart += $item->quantity;
                                        @endphp
                                    @endforeach


                                    <tr class="cart_subtotal">
                                        <th>Tổng Giỏ Hàng</th>
                                        <td class="product-price">
                                            <span class="amount"
                                                id="subtotalAmount">{{ number_format($totalPrice, 0, ',', '.') }} ₫</span>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Phí Vận Chuyển</th>
                                        <td class="product-price" data-shipping="0" id="shipping_fee">
                                            Miễn Phí Vận Chuyển
                                        </td>
                                    </tr>
                                    <tr class="discount">
                                        <th>Giảm Giá</th>
                                        <td class="product-price" id="discount_vs">
                                            <span class="amount" data-discount="0" id="discountAmount">0 ₫</span>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <th>Tổng Cộng</th>
                                        <td class="product-price">
                                            <strong>
                                                <span class="amount" id="totalAmount"
                                                data-total="{{ $totalPrice - $discount }}">
                                                    {{ number_format($totalPrice - $discount, 0, ',', '.') }} ₫
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Form nhập mã giảm giá -->
                    <div class="featured-box featured-box-secondary">
                        <div class="box-content">
                            <h4>Mã Giảm Giá</h4>
                            <div id="voucher_Chose">
                                @if (Auth::user())
                                    <a href="/api/get-voucher/{{Auth::user()->id}}" id="chose_Voucher">
                                        <button id="" class="btn" style="width: 100% !important;display: flex;justify-content: space-between;font-size: 12px;padding: 10px;align-items: center;">
                                            <span class="text" style="display: flex;gap:10px;align-items: center;">
                                                <img width="20px" src="{{asset('assets/client/bootstrap/fonts/voucher-svgrepo-com.svg')}}" alt=""> Chọn mã</span>
                                            <span class="icon">+</span>
                                        </button>
                                    </a>
                                @else
                                    <button id="submitUnLog" class="btn" style="width: 100% !important;display: flex;justify-content: space-between;font-size: 12px;padding: 10px;align-items: center;">
                                        <span class="text" style="display: flex;gap:10px;align-items: center;">
                                            <img width="20px" src="{{asset('assets/client/bootstrap/fonts/voucher-svgrepo-com.svg')}}" alt=""> Chọn mã</span>
                                        <span class="icon">+</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let quantity = {{ $quantityCart }};

        document.getElementById("form-order").addEventListener("submit", function(event) {
            document.getElementById("loader").style.display = "flex";
            document.querySelector("button[type='submit']").disabled = true;
        });
    </script>
    @vite('resources/js/shipping.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
    <script>
        // Modal
        $(document).ready(function () {
            let modal = '';
            // Sử dụng voucher
            $(document).on('click', '#chose_Voucher', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (res) {
                        const today = new Date();
                        let modalElement = $.map(res, function (value, key) {
                            console.log(value);
                            if (value.remaini != 0 && value.status == "Đang diễn ra") {
                                if (value.value == "Phần trăm") {
                                    return `
                                        <div class="item">
                                            <label class="voucher-label" for="voucher_${value.id}">
                                                <div class="banner-voucher">
                                                    <div style="background: #CFF4FC;padding: 10px;">
                                                        <img width="80px" src="{{ asset('assets/client/bootstrap/fonts/voucher-svgrepo-com.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div style="width: 100%;" class="content-voucher">
                                                    <div style="font-size: 16px"><span style="font-size: 18px;">${value.name}</span> <span style="font-weight: 600;">Giảm:</span> <span style="font-size: 18px;">${(value.decreased_value)}</span><span style="font-size: 12px;">%</span> - <span style="font-weight: 600;">Tối đa:</span> <span style="font-size: 18px;">${(value.max_value)}</span><span style="font-size: 12px;">₫</span></div>
                                                    <div style="font-size: 16px"><span style="font-weight: 600;">Đơn tối thiểu:</span> <span style="font-size: 18px;">${(value.condition).toLocaleString('de-DE')}</span><span style="font-size: 12px;">₫</span></div>
                                                    <span style="font-size: 12px;">Số lượng: ${value.remaini}/${value.quanlity}</span>
                                                    <div style="font-size: 12px;"><span style="font-weight: 600;">Giảm giá theo:</span> <span>${value.value}</span> - <span style="font-weight: 600;">Trạng thái:</span> <span>${value.status}</span></div>
                                                </div>
                                                <div class="voucher-check">
                                                    <input style="width: 20px;height: 20px;" type="radio" value="${value.id}" id="voucher_${value.id}" name="voucher_id">
                                                </div>
                                            </label>
                                        </div>
                                    `;
                                }
                                else {
                                    return `
                                        <div class="item">
                                            <label class="voucher-label" for="voucher_${value.id}">
                                                <div class="banner-voucher">
                                                    <div style="background: #CFF4FC;padding: 10px;">
                                                        <img width="80px" src="{{ asset('assets/client/bootstrap/fonts/voucher-svgrepo-com.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div style="width: 100%;" class="content-voucher">
                                                    <div style="font-size: 16px"><span style="font-size: 18px;">${value.name}</span> <span style="font-weight: 600;">Giảm tối đa:</span> <span style="font-size: 18px;">${(value.max_value).toLocaleString('de-DE')}</span><span style="font-size: 12px;">₫</span></div>
                                                    <div style="font-size: 16px"><span style="font-weight: 600;">Đơn tối thiểu:</span> <span style="font-size: 18px;">${(value.condition).toLocaleString('de-DE')}</span><span style="font-size: 12px;">₫</span></div>
                                                    <span style="font-size: 12px;">Số lượng: ${value.remaini}/${value.quanlity}</span>
                                                    <div style="font-size: 12px;"><span style="font-weight: 600;">Giảm giá theo:</span> <span>${value.value}</span> - <span style="font-weight: 600;">Trạng thái:</span> <span>${value.status}</span></div>
                                                </div>
                                                <div class="voucher-check" style="padding: 5px;">
                                                    <input style="width: 20px;height: 20px;" type="radio" value="${value.id}" id="voucher_${value.id}" name="voucher_id">
                                                </div>
                                            </label>
                                        </div>
                                    `;
                                }
                            }
                        }).join('');
                        // if (modalElement == "") {
                        //     modalElement = `<img style="magin: 80px;" src="{{asset('assets/client/bootstrap/fonts/no-data.svg')}}" alt="">`;
                        // }                        
                        let dialog = bootbox.dialog({
                            title: 'Chọn voucher',
                            message: `
                                <div>
                                    <form id="voucherForm" action="{{ route('processVoucher') }}" method="POST">
                                        @csrf
                                        ${modalElement}
                                        <input type="hidden" name="total" value="{{$totalPrice}}">
                                    </form>
                                </div>`,
                            buttons: {
                                cancel: {
                                    label: "Hủy",
                                    className: 'btn-secondary',
                                    callback: function(){
                                        swal("Thông báo!", "Áp dụng mã giảm giá thất bại!", "warning", {
                                            button: false,
                                            timer:1500,
                                        });
                                    }
                                },
                                ok: {
                                    label: "Áp dụng",
                                    className: 'btn-success',
                                    callback: function(){
                                        if ($('input[name="voucher_id"]:checked').val() == undefined) {
                                            return swal("Thông báo!", "Áp dụng mã giảm giá thất bại!", "warning", {
                                                button: false,
                                                timer:1500,
                                            });
                                        }
                                        else {
                                            let url = $('#voucherForm').attr('action');
                                            let data = new FormData($('#voucherForm')[0]);
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: data,
                                                contentType: false,
                                                processData: false,
                                                success: function (res) {
                                            // Sử dụng voucher thành công
                                                    if (res.status == 200) {
                                                        let shipping = $('#input_ship_fee').val();
                                                        let total = $('#totalAmount').data("total");
                                                        let sale;
                                                        let new_total;
                                                        if (res.voucher.value == "Cố định") {
                                                            sale = res.voucher.max_value
                                                            new_total = (Number(total) + Number(shipping)) - Number(sale);
                                                        }
                                                        else if(res.voucher.value == "Phần trăm" && res.voucher.decreased_value <= 100) {
                                                            sale = total*(res.voucher.decreased_value/100);
                                                            if (sale >= res.voucher.max_value) {
                                                                sale = res.voucher.max_value;
                                                            }
                                                            new_total = (Number(total) + Number(shipping)) - Number(sale);
                                                        }
                                                        else {
                                                            sale = 0;
                                                            new_total = (Number(total) + Number(shipping)) - Number(sale);
                                                        }
                                                        $('#voucher_Chose').html(`
                                                            <div class="voucher_Item" style="border: 2px solid #333333;display: flex;align-items: center;justify-content: space-between;">
                                                                <div class="banner-Item" style="padding: 5px;">
                                                                    <img style="width: 50px;" src="{{asset('assets/client/bootstrap/fonts/voucher-svgrepo-com.svg')}}" alt="">
                                                                </div>
                                                                <div style="width: 100%;">
                                                                    <span style="font-size: 14px;font-weight: 600; ">Giảm được: </span> <span style="color: #1abc9c;font-size: 16px;" id="giam_Gia">${(sale.toLocaleString('de-DE')).replace(/,\d+/, '')}</span></span><span style="font-size: 12px;color:#1abc9c;">₫</span>
                                                                </div>
                                                                <div style="padding: 10px;"><a id="delete_voucher" data-id="${res.voucher.id}" href="#unSetVoucher!get" style="color:#ca4242 !important;font-weight: 600;" class="text-danger">Xóa</a></div>
                                                            </div>
                                                        `);
                                                        // Gán giá trị mới
                                                            $('#discountAmount').text(`${(sale.toLocaleString('de-DE')).replace(/,\d+/, '')} ₫`);
                                                            const discountAmount = document.getElementById('discountAmount');
                                                            discountAmount.dataset.discount = sale;
                                                        // Tổng mới
                                                            $('#totalAmount').text(`${(new_total.toLocaleString('de-DE')).replace(/,\d+/, '')} ₫`);
                                                            const totalAmount = document.getElementById('totalAmount');
                                                            totalAmount.dataset.total = new_total;
                                                        // Định dạng id VOucher
                                                            $('#Vs_code').val(res.voucher.id);
                                                    }
                                            // Sử dụng thất bại
                                                    else {
                                                        return swal("Thông báo!", `${res.errors}`, "warning", {
                                                            button: false,
                                                            timer:1500,
                                                        });
                                                    }
                                                },
                                            });
                                        }
                                        swal("Thông báo!", "Áp dụng mã giảm giá thành công!", "success", {
                                            button: false,
                                            timer:1500,
                                        });
                                    }
                                }
                            }
                        });
                    }
                });
            });
            // Xóa sử dụng
            $(document).on('click', '#delete_voucher', function (e) {
                e.preventDefault();
                let total = {{$totalPrice}};
                let shipping = $('#input_ship_fee').val();
                let sale = $('#discountAmount').data('discount');
                let new_total;
                // Xóa hiển thị
                $('#voucher_Chose').html(`
                    @if (Auth::user())
                        <a href="/api/get-voucher/{{Auth::user()->id}}" id="chose_Voucher">
                            <button id="" class="btn" style="width: 100% !important;display: flex;justify-content: space-between;font-size: 12px;padding: 10px;align-items: center;">
                                <span class="text" style="display: flex;gap:10px;align-items: center;">
                                    <img width="20px" src="{{asset('assets/client/bootstrap/fonts/voucher-svgrepo-com.svg')}}" alt=""> Chọn mã</span>
                                <span class="icon">+</span>
                            </button>
                        </a>
                    @else
                        <button id="submitUnLog" class="btn" style="width: 100% !important;display: flex;justify-content: space-between;font-size: 12px;padding: 10px;align-items: center;">
                            <span class="text" style="display: flex;gap:10px;align-items: center;">
                                <img width="20px" src="{{asset('assets/client/bootstrap/fonts/voucher-svgrepo-com.svg')}}" alt=""> Chọn mã</span>
                            <span class="icon">+</span>
                        </button>
                    @endif
                `);
                // Dữ liệu mới sau khi xóa
                if (sale != 0) {
                    sale = 0;
                }
                new_total = Number(total) + Number(shipping) - Number(sale);
                // Set lại dữ liệu
                    $('#discountAmount').text(`${(sale.toLocaleString('de-DE')).replace(/,\d+/, '')} ₫`);
                    const discountAmount = document.getElementById('discountAmount');
                    discountAmount.dataset.discount = sale;
                // Tổng mới
                    $('#totalAmount').text(`${(new_total.toLocaleString('de-DE')).replace(/,\d+/, '')} ₫`);
                    const totalAmount = document.getElementById('totalAmount');
                    totalAmount.dataset.total = new_total;
                // Định dạng id VOucher
                    $('#Vs_code').val(null);
            });
            $(document).on('click', '#submitUnLog', function (e) {
                e.preventDefault();
                swal("Thông báo!", "Bạn chưa đăng nhập, không thể dùng voucher!", "warning", {
                    button: false,
                    timer:1500,
                });
            });
        });

    </script>
@endsection
