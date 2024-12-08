<?php

namespace App\Providers;

use App\Services\Size\SizeService;
use App\Services\Size\ISizeService;
use App\Services\Color\ColorService;
use App\Services\Order\OrderService;
use App\Services\Color\IColorService;
use App\Services\Order\IOrderService;
use Illuminate\Support\ServiceProvider;
use App\Services\Product\ProductService;
use App\Services\Product\VariantService;
use App\Services\Product\IProductService;
use App\Services\Product\IVariantService;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IColorService::class, ColorService::class);
        $this->app->bind(ISizeService::class, SizeService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IVariantService::class, VariantService::class);
        $this->app->bind(IOrderService::class, OrderService::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
