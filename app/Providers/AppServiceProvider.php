<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Services\PermissionGateAndPolicy;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
        //////////////////////////////// GATE CATEGORY ////////////////////////
        $permissionGatePolicy = new PermissionGateAndPolicy();
        $permissionGatePolicy->defineCategoryGate();
        //////////////////////////////// GATE MENU ////////////////////////////
        $permissionGatePolicy->defineMenuGate();
        //////////////////////////////// GATE PRODUCT /////////////////////////
        $permissionGatePolicy->defineProductGate();
        //////////////////////////////// GATE SLIDER //////////////////////////
        $permissionGatePolicy->defineSliderGate();
        //////////////////////////////// GATE SETTING /////////////////////////
        $permissionGatePolicy->defineSettingGate();
        //////////////////////////////// GATE USER ////////////////////////////
        $permissionGatePolicy->defineUserGate();
        //////////////////////////////// GATE ROLE ////////////////////////////
        $permissionGatePolicy->defineRoleGate();
    }



}
