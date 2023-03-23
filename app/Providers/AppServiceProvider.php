<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
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
        setlocale(LC_TIME, 'id_ID');
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Blade::directive('hari', function ($data) {
            return "<?php echo ($data)->isoFormat('dddd'); ?>";
        });

        Blade::directive('tanggal', function ($data) {
            return "<?php echo ($data)->isoFormat('D MMMM Y'); ?>";
        });

        Blade::directive('uang', function ($data) {
            return "Rp. <?php echo number_format($data,0,',','.'); ?>";
        });

        Paginator::useBootstrapFive();
    }
}
