@extends('admin.layouts.master')

@section('title')
    Quản lý đơn hàng
@endsection
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
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-data__tool">
                    <form class="form-inline" method="GET">
                        <div class="form-group mr-3">
                            <label for="status">Trạng thái:</label>
                            <select class="form-control ml-2" name="status" id="status">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tất cả</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->name_status }}"
                                        {{ request('status') == $status->name_status ? 'selected' : '' }}>
                                        {{ $status->status_label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <label for="date">Ngày đặt:</label>
                            <input type="date" class="form-control ml-2" name="date" id="date"
                                value="{{ request('date') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>

                </div>
                <div class="flex flex-col items-start gap-5 md:flex-row md:items-center md:justify-between">
                    <div class="flex flex-wrap gap-x-6 gap-y-4">
                        <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" class="mr-3">Tất cả <span
                                class="small border border-2 rounded bg-body-secondary p-2 ml-1">({{ $totalOrder }})</span></a>
                        @foreach ($countOrderByStatus as $item)
                            @if ($item->status_order_id == 5 || $item->status_order_id == 7)
                                @continue
                            @else
                                <a href="{{ route('admin.orders.index', ['status' => $item->name_status]) }}"
                                    class="mr-3 text-capitalize">{{ $item->name_status }}<span
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
                                    <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
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
                                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                                <button class="item mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Xem chi tiết đơn hàng">
                                                    <i class="fas fa-eye"></i>
                                                </button></a>

                                                @if ($order->statusOrder->contains('name_status', 'canceled'))    
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có muốn xóa không')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="item mr-2" data-toggle="tooltip"
                                                    data-placement="top" title="Xóa đơn hàng">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
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
