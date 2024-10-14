@extends('admin.layouts.master')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35 mt-3">Danh sách Đơn hàng</h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="property">
                                <option selected="selected">Danh mục</option>
                                {{-- @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach --}}
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="time">
                                <option selected="selected">Sắp xếp</option>
                                <option value="">Mới nhất</option>
                                <option value="">Cũ nhất</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter">
                            <i class="zmdi zmdi-filter-list"></i>Lọc</button>
                    </div>
                    <form class="au-form-icon" action="" method="GET">
                        <input class="au-input--w300 au-input--style2" name="search" value="{{ request('search') }}"
                            type="text" placeholder="Tìm kiếm..." />
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin.products.create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Thêm</button>
                        </a>

                    </div>
                </div>
                <div class="flex flex-col items-start gap-5 md:flex-row md:items-center md:justify-between">
                    <div class="flex flex-wrap gap-x-6 gap-y-4">
                        <button class="mr-3">Tất cả <span
                                class="small border border-2 rounded bg-body-secondary p-2 ml-1">(15)</span></button>
                        <button class="mr-3">Tất cả <span
                                class="small border border-2 rounded bg-body-secondary p-2 ml-1">(15)</span></button>
                        <button class="mr-3">Tất cả <span
                                class="small border border-2 rounded bg-body-secondary p-2 ml-1">(15)</span></button>
                        <button class="mr-3">Tất cả <span
                                class="small border border-2 rounded bg-body-secondary p-2 ml-1">(15)</span></button>
                        <button class="mr-3">Tất cả <span
                                class="small border border-2 rounded bg-body-secondary p-2 ml-1">(15)</span></button>
                    </div>
                    <br />
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="tr-shadow">
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        ORDER-01
                                    </td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>

                                        @foreach ($order->statuses as $key => $value)
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <select name="status_order" class="form-select w-75"
                                                    onchange="confirmSubmit(this)"
                                                    data-default-value='{{ $key + 1 }}'>
                                                    @foreach ($statuses as $status)
                                                        <option value="{{ $status->id }}"
                                                            {{ $key == $status->id ? 'selected' : '' }}
                                                            >
                                                            {{ $status->name_status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        @endforeach

                                        </form>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">

                                            {{-- Xem chi tiết  --}}
                                            <a href="">
                                                <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Xem chi tiết đơn hàng">
                                                    <i class="fas fa-eye"></i>
                                                </button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function confirmSubmit(selectElement) {
            var form = selectElement.form;
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var defaultValue = selectElement.getAttribute('data-default-value');

            if (confirm('Bạn có chắc chắn thay đổi trạng thái đơn hàng thành "' + selectedOption + '" không ?')) {
                form.submit();
            } else {
                selectElement.value = defaultValue;
            }
        }
    </script>
@endsection
