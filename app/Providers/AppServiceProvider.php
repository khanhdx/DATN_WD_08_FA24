<?php

namespace App\Providers;

use App\Services\Color\ColorService;
use App\Services\Color\IColorService;
use App\Services\Order\IOrderService;
use App\Services\Order\OrderService;
use App\Services\Product\IProductService;
use App\Services\Product\IVariantService;
use App\Services\Product\ProductService;
use App\Services\Product\VariantService;
use App\Services\Size\ISizeService;
use App\Services\Size\SizeService;
use Illuminate\Support\ServiceProvider;

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
        //
    }
}
