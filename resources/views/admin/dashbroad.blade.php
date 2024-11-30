@extends('admin.layouts.master')

@section('css')
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- STATISTIC-->
    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">10,368</h2>
                            <span class="desc">members online</span>
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">388,688</h2>
                            <span class="desc">items sold</span>
                            <div class="icon">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">1,086</h2>
                            <span class="desc">this week</span>
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">$1,060,386</h2>
                            <span class="desc">total earnings</span>
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
                                    <label for="startRevenueDate">Từ ngày:</label>
                                    <input type="date" id="startRevenueDate" name="start_date">
                                    
                                    <label for="endRevenueDate">Đến ngày:</label>
                                    <input type="date" id="endRevenueDate" name="end_date">
                                    
                                    <button id="updateRevenueChartButton">Cập nhật biểu đồ</button>
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
                                    <div class="chart-info">
                                        <div class="date-filter">
                                            <label for="startOrderDate">Từ ngày:</label>
                                            <input type="date" id="startOrderDate" name="start_date">
                                            
                                            <label for="endOrderDate">Đến ngày:</label>
                                            <input type="date" id="endOrderDate" name="end_date">
                                            
                                            <button id="updateOrderChartButton">Cập nhật biểu đồ</button>
                                        </div>
                                    </div>
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
                                <h3 class="title-3">Top sản phẩm bán chạy nhất</h3>
                                <div class="recent-report__chart">
                                <canvas id="mostOrderedProductChart" width="400" height="200"></canvas>
                            </div>
                            </div>
                        </div>
                        <div class="recent-report2">
                            <div class="recent-report__chart">
                                <h3 class="title-3">Số lượng tồn kho sản phầm</h3>
                                <div class="recent-report__chart">
                                <canvas id="inventoryChart" width="400" height="200"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END RECENT REPORT 2 -->
            </div>
        </div>
    </section>

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6">
                        <!-- USER DATA-->
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="zmdi zmdi-account-calendar"></i>user data
                            </h3>
                            <div class="filters m-b-45">
                                <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">All Properties</option>
                                        <option value="">Products</option>
                                        <option value="">Services</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                    <select class="js-select2 au-select-dark" name="time">
                                        <option selected="selected">All Time</option>
                                        <option value="">By Month</option>
                                        <option value="">By Day</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                            <div class="table-responsive table-data">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>name</td>
                                            <td>role</td>
                                            <td>type</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>lori lynch</h6>
                                                    <span>
                                                        <a href="#">johndoe@gmail.com</a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="role admin">admin</span>
                                            </td>
                                            <td>
                                                <div class="rs-select2--trans rs-select2--sm">
                                                    <select class="js-select2" name="property">
                                                        <option selected="selected">Full Control</option>
                                                        <option value="">Post</option>
                                                        <option value="">Watch</option>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="more">
                                                    <i class="zmdi zmdi-more"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox" checked="checked">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>lori lynch</h6>
                                                    <span>
                                                        <a href="#">johndoe@gmail.com</a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="role user">user</span>
                                            </td>
                                            <td>
                                                <div class="rs-select2--trans rs-select2--sm">
                                                    <select class="js-select2" name="property">
                                                        <option value="">Full Control</option>
                                                        <option value="" selected="selected">Post
                                                        </option>
                                                        <option value="">Watch</option>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="more">
                                                    <i class="zmdi zmdi-more"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>lori lynch</h6>
                                                    <span>
                                                        <a href="#">johndoe@gmail.com</a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="role user">user</span>
                                            </td>
                                            <td>
                                                <div class="rs-select2--trans rs-select2--sm">
                                                    <select class="js-select2" name="property">
                                                        <option value="">Full Control</option>
                                                        <option value="" selected="selected">Post
                                                        </option>
                                                        <option value="">Watch</option>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="more">
                                                    <i class="zmdi zmdi-more"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="table-data__info">
                                                    <h6>lori lynch</h6>
                                                    <span>
                                                        <a href="#">johndoe@gmail.com</a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="role member">member</span>
                                            </td>
                                            <td>
                                                <div class="rs-select2--trans rs-select2--sm">
                                                    <select class="js-select2" name="property">
                                                        <option selected="selected">Full Control</option>
                                                        <option value="">Post</option>
                                                        <option value="">Watch</option>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="more">
                                                    <i class="zmdi zmdi-more"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="user-data__footer">
                                <button class="au-btn au-btn-load">load more</button>
                            </div>
                        </div>
                        <!-- END USER DATA-->
                    </div>
                    <div class="col-xl-6">
                        <!-- MAP DATA-->
                        <div class="map-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="zmdi zmdi-map"></i>map data
                            </h3>
                            <div class="filters">
                                <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">All Worldwide</option>
                                        <option value="">Products</option>
                                        <option value="">Services</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                    <select class="js-select2 au-select-dark" name="time">
                                        <option selected="selected">All Time</option>
                                        <option value="">By Month</option>
                                        <option value="">By Day</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                            <div class="map-wrap m-t-45 m-b-80">
                                <div id="vmap" style="height: 284px;"></div>
                            </div>
                            <div class="table-wrap">
                                <div class="table-responsive table-style1">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>United States</td>
                                                <td>$119,366.96</td>
                                            </tr>
                                            <tr>
                                                <td>Australia</td>
                                                <td>$70,261.65</td>
                                            </tr>
                                            <tr>
                                                <td>United Kingdom</td>
                                                <td>$46,399.22</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive table-style1">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Germany</td>
                                                <td>$20,366.96</td>
                                            </tr>
                                            <tr>
                                                <td>France</td>
                                                <td>$10,366.96</td>
                                            </tr>
                                            <tr>
                                                <td>Russian</td>
                                                <td>$5,366.96</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END MAP DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/revenue-chart.js') }}"></script>
    <script src="{{ asset('assets/js/order-chart.js') }}"></script>
    <script src="{{ asset('assets/js/product-chart.js') }}"></script>
@endsection
