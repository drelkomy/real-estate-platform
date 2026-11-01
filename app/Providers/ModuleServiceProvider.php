<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register modular service providers.
     */
    public function register(): void
    {
        $modulesDirectory = app_path('Modules');

        if (File::exists($modulesDirectory)) {
            $modules = array_map('basename', File::directories($modulesDirectory));

            foreach ($modules as $module) {
                $providerClass = "App\\Modules\\{$module}\\Providers\\{$module}ServiceProvider";

                if (class_exists($providerClass)) {
                    $this->app->register($providerClass);
                }
            }
        }
    }

    /**
     * Bootstrap any module services.
     */
    public function boot(): void
    {
        //
    }
}

