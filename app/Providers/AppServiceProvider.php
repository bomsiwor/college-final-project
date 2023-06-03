<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

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
            return "<?php echo ($data)->isoFormat('dddd, D MMMM Y'); ?>";
        });

        Blade::directive('uang', function ($data) {
            return "Rp. <?php echo number_format($data,0,',','.'); ?>";
        });

        Paginator::useBootstrapFive();

        // Fix https
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $this->app['request']->server->set('HTTPS', true);
        }

        // Response
        // 200
        Response::macro('success', function ($data = null, $message = 'Sukses') {
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => $message,
                'data' => $data
            ]);
        });

        // 201
        Response::macro('created', function ($data = null, $message = "tersimpan") {
            return response()->json([
                'code' => 201,
                'success' => true,
                'message' => "Sukses $message!",
                'data' => $data
            ], 201);
        });
    }
}
