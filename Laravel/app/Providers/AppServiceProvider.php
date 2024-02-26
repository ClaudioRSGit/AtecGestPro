<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
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
        Blade::directive('showIfNotDeleted', function ($expression) {
            return "<?php if (! isset({$expression}->deleted_at)) : ?>";
        });

        Blade::directive('endshowIfNotDeleted', function () {
            return '<?php endif; ?>';
        });
    }
}
