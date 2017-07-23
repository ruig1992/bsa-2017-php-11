<?php
namespace App\Providers;

use App\Fractal\{
    CarFractal,
    Contracts\CarFractal as CarFractalContract
};
use Illuminate\Support\ServiceProvider;

/**
 * Class FractalServiceProvider
 * @package App\Providers
 */
class FractalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // method body
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        // method body
        $this->app->bind(CarFractalContract::class, CarFractal::class);
    }
}
