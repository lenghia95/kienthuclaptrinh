<?php

namespace App\Providers;

use App\Models\Setting;
use View;
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
        
        $settings = Setting::get();
        foreach($settings as $set)
        {
            $setting[$set->key] = $set->value;
        }
        View::share('Setting', $setting);
    }
}
