@php
    use App\Models\Category;
    use App\Models\Product;
    $categories = Category::query()->get();
    $prs = Product::query()->orderBy('created_at','desc')->limit(3)->get();
@endphp

<nav class="navbar navbar-default navbar-main navbar-main-slide" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span
                    class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                <span class="icon-bar"></span> </button>
            <a class="logo" href="/"><img src="/assets/client/images/logo.png" alt="Flatize"></a>
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
                        data-toggle="dropdown">Shop
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
                                                        <a href="{{ route('client.product.show', $pr->id) }}"><img alt="" width="60" src="{{ $pr->image }}"></a>
                                                    </div>
                                                    <div class="product-thumb-info-content">
                                                        <h4><a href="{{ route('client.product.show', $pr->id) }}">{{$pr->name}}</a></h4>
                                                        <span class="item-cat"><small><a
                                                                    href="#">{{ $pr->category->name }}</a></small></span>
                                                        <span class="price">{{ number_format($pr->price_regular,0,'','.') }}đ</span>
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
                                                <li><a href="#" onclick="openCategory({{ $category->id }})">{{ $category->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-2 menu-column">
                                    <h3>Woman</h3>
                                    <ul class="list-unstyled sub-menu">
                                        @foreach ($categories as $item)
                                            @if ($item->type == 'Woman')
                                                <li><a href="#" onclick="openCategory({{ $item->id }})">{{ $item->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-4 hidden-sm hidden-xs menu-column">
                                    <h3>Explore new collection</h3>
                                    <ul class="list-unstyled sub-menu list-md-pro">
                                        <li class="product">
                                            <div class="product-thumb-info">
                                                <div class="product-thumb-info-image">
                                                    <a href="shop-product-detail1.html"><img class="img-responsive"
                                                            width="330" alt=""
                                                            src="/assets/client/images/content/products/ad-1.png"></a>
                                                </div>

                                                <div class="product-thumb-info-content">
                                                    <h4><a href="shop-product-detail2.html">Men’s Fashion and Style</a>
                                                    </h4>
                                                    <p>Whatever you’re looking for, be it the latest fashion trends,
                                                        cool outfit ideas or new ways to wear your favourite pieces,
                                                        we’ve got all the style inspiration you need.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li><a href="{{ route('client.post.index') }}">Blog</a></li>
                <li><a href="{{ route('client.contact') }}">Liên hệ</a></li>
                <li><a href="{{ route('client.voucher.index') }}">Voucher</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function openCategory (id) {
        const route = window.location.pathname;
        if (route !== "/products") {
            const url = "{{ route('client.product.index')}}"+"?type="+id;
            console.log(url);
            window.location.href = url;
        }
        else {
            filterByCategory(id);
        }
    }
</script>