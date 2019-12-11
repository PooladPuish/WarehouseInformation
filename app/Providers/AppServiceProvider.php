<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\SalesCustomers\Entities\SalesCustomers;
use Modules\SalesCustomers\Jobs\SyncUser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //پیام تایید
        function ReturnMsgSuccess($msg)
        {
            return redirect()->back()->with('success-message', $msg);
        }

        //پیام اخطار
        function ReturnMsgError($msg)
        {
            return redirect()->back()->with('error-message', $msg);

        }

        //پیام اطلاع رسانی
        function ReturnMsgInfo($msg)
        {
            return redirect()->back()->with('info-message', $msg);

        }

    }
}
