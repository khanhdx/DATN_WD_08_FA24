@extends('admin.layouts.master')

@section('css')
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
    {{--  Filter --}}
    <section>
        <div class="section__content section__content--p30" style="margin-bottom: 16px">
            <div class="date-filter row align-items-center g-3">
                <div class="container-fluid" style="margin-left: 14px">
                    <div class="row">
                        <div class="col">
                            <label for="startDate" class="form-label">Từ ngày:</label>
                            <input type="date" id="startDate" name="start_date" class="form-control">
                        </div>

                        <div class="col">
                            <label for="endDate" class="form-label">Đến ngày:</label>
                            <input type="date" id="endDate" name="end_date" class="form-control">
                        </div>

                        <div class="col d-flex align-items-end" style="max-width: 140px">
                            <button id="updateAllChartsButton" class="btn btn-primary w-100">Kiểm tra</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- STATISTIC-->
    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    {{-- Khách hàng --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number" id="countCustomer">...</h2>
                            <span class="desc">Khách hàng</span>
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                        </div>
                    </div>
                    {{-- Sản phẩm đã bán --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number" id="totalSoldQuantity">...</h2>
                            <span class="desc">sản phẩm đã bán</span>
                            <div class="icon">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    {{-- Đơn hàng --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number" id="countOrder">...</h2>
                            <span class="desc">Đơn hàng</span>
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                        </div>
                    </div>
                    {{-- Tổng doanh thu --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number" id="totalRevenue">...</h2>
                            <span class="desc">doanh thu</span>
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- RECENT REPORT 2-->
                        <div class="recent-report2">
                            <h3 class="title-3">Biểu đồ doanh thu</h3>
                            <div class="chart-info">
                                <div class="date-filter">

                                </div>
                            </div>
                            <div class="recent-report__chart">
                                <canvas id="revenueChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 ">
                                <div class="recent-report2">
                                    <h3 class="title-3">Biểu đồ Đơn hàng</h3>
                                    <div class="recent-report__chart">
                                        <canvas id="orderChart" width="400" height="200"></canvas>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="recent-report2">
                                    <h3 class="title-3">Trạng thái đơn hàng</h3>
                                    <div class="recent-report__chart">
                                        <canvas id="orderStatusPieChart" width="400" height="400"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="recent-report2">
                            <div class="recent-report__chart">
                                <h3 class="title-3">Top sản phẩm bán chạy nhất trong tháng</h3>
                                <div class="recent-report__chart">
                                    <canvas id="mostOrderedProductChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="recent-report2">
                            <div class="table-responsive-inventory" >
                                <table class="table table-bordered table-striped" id="inventoryTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng tồn kho</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="inventoryTableBody"></tbody>
                                </table>
                                <nav>
                                    <ul class="pagination justify-content-center mt-2" id="pagination"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END RECENT REPORT 2 -->
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/admin/js/dashbroad.js') }}"></script>
    <script src="{{ asset('assets/admin/js/statistic.js') }}"></script>
    <script src="{{ asset('assets/admin/js/revenue-chart.js') }}"></script>
    <script src="{{ asset('assets/admin/js/order-chart.js') }}"></script>
    <script src="{{ asset('assets/admin/js/product-chart.js') }}"></script>
@endsection
