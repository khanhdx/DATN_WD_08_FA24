@php
    use App\Models\Category;
    use App\Models\Product;
    use App\Models\Voucher;
    use Carbon\Carbon;
    $categories = Category::query()->get();
    $prs = Product::with('image')->orderBy('created_at', 'desc')->limit(3)->get();
    $today = Carbon::today();
    $vs = Voucher::query()
        ->where('type_code', '=', 'Công khai')
        ->where('date_start', '<=', $today)
        ->where('date_end', '>=', $today)
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

    if (Auth::user()) {
        $ware = Auth::user()->vouchers_ware;
    }
@endphp

<nav class="navbar navbar-default navbar-main navbar-main-slide" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span
                    class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                <span class="icon-bar"></span> </button>
            <a class="logo" href="/"><img src="/assets/client/images/logo_obito.png" alt="Flatize"></a>
        </div>
        <ul class="nav navbar-nav navbar-act pull-right">


            <li class="search">
                <a href="" data-toggle="modal" data-target=".bs-example-modal-lg">
                    <i class="fa fa-search"></i>
                </a>
            </li>

        </ul>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">

                <li class="dropdown megamenu">
                    <a href="{{ route('client.product.index') }}" class="dropdown-toggle dropdownLink"
                        data-toggle="dropdown">Cửa hàng
                    </a>
                    <div class="dropdown-menu">
                        <div class="mega-menu-content">
                            <div class="row">
                                <div class="col-md-4 hidden-sm hidden-xs menu-column">
                                    <h3>NEW</h3>
                                    <ul class="list-unstyled sub-menu list-thumbs-pro">
                                        @foreach ($prs as $pr)
                                            <li class="product">
                                                <div class="product-thumb-info">
                                                    <div class="product-thumb-info-image">
                                                        <a href="{{ route('client.product.show', $pr->id) }}"><img
                                                                alt="" width="60"
                                                                src="{{ \Storage::url($pr->image->image_url) }}"></a>
                                                    </div>
                                                    <div class="product-thumb-info-content">
                                                        <h4><a
                                                                href="{{ route('client.product.show', $pr->id) }}">{{ $pr->name }}</a>
                                                        </h4>
                                                        <span class="item-cat"><small><a
                                                                    href="#">{{ $pr->category->name }}</a></small></span>
                                                        <span
                                                            class="price">{{ number_format($pr->price_regular, 0, '', '.') }}đ</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-2 menu-column">
                                    <h3>Man</h3>
                                    <ul class="list-unstyled sub-menu">
                                        @foreach ($categories as $category)
                                            @if ($category->type == 'Man')
                                                <li><a href="#"
                                                        onclick="openCategory({{ $category->id }})">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-2 menu-column">
                                    <h3>Woman</h3>
                                    <ul class="list-unstyled sub-menu">
                                        @foreach ($categories as $item)
                                            @if ($item->type == 'Woman')
                                                <li><a href="#"
                                                        onclick="openCategory({{ $item->id }})">{{ $item->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-4 hidden-sm hidden-xs menu-column">
                                    <h3>VOUCHER</h3>
                                    <ul class="list-unstyled sub-menu list-md-pro">
                                        @forelse ($vs as $voucher)
                                            <li class="product">
                                                <div class="product-thumb-info"
                                                    style="border-top: 1px solid #FFFFFF;border-bottom: 1px solid #FFFFFF;display: flex;align-items: center;padding: 10px 0px;gap:10px;">
                                                    <div class="product-thumb-info-image m-0"
                                                        style="clip-path: polygon(0% -1%, 100% -1%, 100% 100%, 50% 75%, 0% 100%);background-color: #FFFFFF;color: #000000;">
                                                        @if ($voucher->value === 'Cố định')
                                                            <h4 class="m-0" style="padding: 15px 2px">
                                                                {{ preg_replace('/0{3}$/', 'k', $voucher->decreased_value) }}
                                                            </h4>
                                                        @else
                                                            <h4 class="m-0" style="padding: 15px 2px">
                                                                {{ $voucher->decreased_value }}%</h4>
                                                        @endif
                                                    </div>
                                                    <div class="product-thumb-info-content"
                                                        style="display: grid;grid-template-columns: 2fr 1fr;width: 100%;align-items: center;">
                                                        <div>
                                                            <h4 class="m-0"><a
                                                                    href="{{ route('client.voucher.show', $voucher->id) }}">{{ $voucher->name }}</a>
                                                            </h4>
                                                            <p style="color: #FFFFFF;font-size: 12px;margin: 0px;">
                                                                <strong>Mã: </strong> {{ $voucher->voucher_code }}</p>
                                                        </div>
                                                        @if (Auth::user())
                                                            @if ($ware->wares_list->where('voucher_id',$voucher->id)->first())
                                                                <button
                                                                    style="border: 2px solid #FFFF;min-width: 50px;padding: 4px 10px;color: #FFF;width: 100%;margin-top: 0px !important;"
                                                                    class="btn btn-save" disabled>Đã lưu</button>
                                                            @elseif ($voucher->remaini == 0)
                                                                <button
                                                                style="border: 2px solid #FFFF;min-width: 50px;padding: 4px 10px;color: #FFF;width: 100%;margin-top: 0px !important;"
                                                                class="btn btn-save" disabled>Đã hết</button>
                                                            @else
                                                                <form class="voucher-form"
                                                                    id="voucherForm{{ $voucher->id }}"
                                                                    onsubmit="formVoucher({{ $voucher->id }})"
                                                                    action="{{ route('client.voucher.update', $voucher->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="voucher_id"
                                                                        value="{{ $voucher->id }}">
                                                                    <button
                                                                        style="border: 2px solid #FFFF;min-width: 50px;padding: 4px 10px;color: #FFF;width: 100%;margin-top: 0px !important;"
                                                                        class="btn btn-save LuuVoucher">Lưu</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($voucher->remaini == 0)
                                                            <button
                                                            style="border: 2px solid #FFFF;min-width: 50px;padding: 4px 10px;color: #FFF;width: 100%;margin-top: 0px !important;"
                                                            class="btn btn-save" disabled>Đã hết</button>
                                                        @else
                                                            <button
                                                                style="border: 2px solid #FFFF;min-width: 50px;padding: 4px 10px;color: #FFF;width: 100%;margin-top: 0px !important;"
                                                                class="btn btn-save saveVoucher">Lưu</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <div style="display: flex;align-items: center;">
                                                <img src="{{ asset('assets/client/bootstrap/fonts/no-data.svg') }}"
                                                    alt="">
                                            </div>
                                        @endforelse

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li><a href="{{ route('client.post.index') }}">Bài viết</a></li>
                <li><a href="{{ route('client.contact') }}">Liên hệ</a></li>
                <li><a href="{{ route('client.voucher.index') }}">Mã giảm giá</a></li>
                {{-- Seaarch bill --}}
                <li>
                    <a href="{{ route('search.bill') }}" class="dropdown-toggle dropdownLink"
                        data-toggle="dropdown">
                        Tìm kiếm hóa đơn
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function openCategory(id) {
        const route = window.location.pathname;
        if (route !== "/products") {
            const url = "{{ route('client.product.index') }}" + "?type=" + id;
            console.log(url);
            window.location.href = url;
        } else {
            filterByCategory(id);
        }
    }
</script>