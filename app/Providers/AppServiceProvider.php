<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        Validator::extend("nationalCode", function ($attr, $code, $parameters) {
            if (!preg_match('/^[0-9]{10}$/', $code))
                return false;
            for ($i = 0; $i < 10; $i++)
                if (preg_match('/^' . $i . '{10}$/', $code))
                    return false;
            for ($i = 0, $sum = 0; $i < 9; $i++)
                $sum += ((10 - $i) * intval(substr($code, $i, 1)));
            $ret = $sum % 11;
            $parity = intval(substr($code, 9, 1));
            if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
                return true;
            return false;
        } , "کد ملی وارد شده صحیح نمیباشد.");


        Validator::extend("iranPostalCode", function ($attr, $code, $parameters) {
            return (bool) (strlen($code) == 10 && preg_match(@"/(?!(\d)\1{3})[13-9]{4}[1346-9][013-9]{5}/" , $code));
        } , "کد پستی وارد شده صحیح نمیباشد.");


        Validator::extend("phone", function ($attr, $phone, $parameters) {
            return preg_match("/^09\d{9}$/" , $phone);
        } , "شمارت تلفن وارد شده صحیح نمیباشد. مثال : ۰۹۱۳۲۰۵۳۴۰۹");

        $this->app->setLocale('fa');
        //
    }
}
