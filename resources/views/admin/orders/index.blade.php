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
                        <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" class="mr-3">Tất cả <span
                                class="small border border-2 rounded bg-body-secondary p-2 ml-1">({{ $totalOrder }})</span></a>
                        @foreach ($countOrderByStatus as $item)
                            @if ($item->status_order_id == 5 || $item->status_order_id == 7)
                                @continue
                            @else
                                <a href="{{ route('admin.orders.index', ['status' => $item->name_status]) }}" class="mr-3 text-capitalize">{{ $item->name_status }}<span
                                        class="small border border-2 rounded bg-body-secondary p-2 ml-1">({{ $item->total }})</span></a>
                            @endif
                        @endforeach
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
                                    <td>{{ $order->total_price }} đ</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>

                                        @foreach ($order->statusOrder as $c_status)
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <select name="status_order" class="form-select w-75"
                                                    onchange="confirmSubmit(this)"
                                                    data-default-value='{{ $c_status['id_status'] }}'>
                                                    @foreach ($statuses as $status)
                                                        <option value="{{ $status->id }}"
                                                            {{ $c_status['id_status'] == $status->id ? 'selected' : '' }}
                                                            {{ $c_status['id_status'] == 6 ? 'disabled' : '' }}
                                                            {{ $c_status['id_status'] == 8 ? 'disabled' : '' }}>
                                                            {{ $status->status_label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @endforeach

                                    </td>
                                    <td>
                                        <div class="table-data-feature">

                                            {{-- Xem chi tiết  --}}
                                            <a href="{{ route('admin.orders.show',$order->id) }}">
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