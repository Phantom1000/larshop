<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::directive('activeroute', function ($route) {
            return "<?php echo Route::currentRouteNamed($route) ? 'active' : '' ?>";
        });

        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->is_admin;
        });

        Product::observe(ProductObserver::class);
    }
}
