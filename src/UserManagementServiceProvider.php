<?php

namespace Smbplus\UserManagement;

use Illuminate\Support\ServiceProvider;
use Smbplus\UserManagement\Helpers\Calculator;
use Smbplus\UserManagement\Console\InstallCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;

class UserManagementServiceProvider extends ServiceProvider
{
  public function register()
  {
    //merge config to lrv config
    //$this->mergeConfigFrom(__DIR__.'/../config/config.php', 'smbplus_um');

    //register a facade - Lrv app will use 
    $this->app->bind('calculator', function($app) {
        return new Calculator();
    });
    
  }

  public function boot()
  {
    /*Auth::provider('spum_admin', function ($app, $config) {
        // change this to your Admin model's FQCN
        $model = \Smbplus\UserManagement\Models\User::class;

        return new EloquentUserProvider($app->make(Hasher::class), $model);
    });

    // Register new guard driver with AuthManager
    Auth::extend('spum_admin', function ($app, $name, $config) {
        // as you are doing a package, we will override
        // the config that usually would come
        // from `./auth/config.php
        $config = [
            'provider' => 'spum_admin',
        ];

        return Auth::createSessionDriver($name, $config);
    });
    */
    //set new guard
    \Config::set('auth.guards.spum_admin', [
        'driver' => 'session',
        'provider' => 'spum',
    ]);

    // Will use the EloquentUserProvider driver with the Admin model
    \Config::set('auth.providers.spum', [
        'driver' => 'eloquent',
        'model' => \Smbplus\UserManagement\Models\User::class,
    ]);

    //register a command
    if ($this->app->runningInConsole()) {
        $this->commands([
            InstallCommand::class,
        ]);
    }

    //create config file in lrv project
    if ($this->app->runningInConsole()) {

        $this->publishes([
          __DIR__.'/config/config.php' /* config file in package */ => config_path('smbplus_um.php') /* config file will be created in lrv project */,
        ], 'config' /* tag to run vendor:publish */);

        //to publish this config in lrv project, run below command
        //php artisan vendor:publish --provider="Smbplus\UserManagement\UserManagementServiceProvider" --tag="config"
    
    }

    /** migration - Copy a sample migration file and edit it ;)
    * there are 2 methods to run migration
    * copy migration files to lrv project and run migration
    * or run migraiton files directly from package
    */

    //method 1
    if ($this->app->runningInConsole()) {
        // Export the migration
        /*
        if (! class_exists('CreatePostsTable')) {
          $this->publishes([
            __DIR__ . '/database/migrations/create_posts_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_posts_table.php'),
            //can add any number of migrations here
          ], 'migrations');

          //publish migration files:
          //php artisan vendor:publish --provider="Smbplus\UserManagement\UserManagementServiceProvider" --tag="migrations"
        }*/
    }
    //method 2:
    $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

    /* Load route for package */
    $this->registerRoutes();

    /* Load views */
    $this->loadViewsFrom(__DIR__.'/resources/views', 'spum'/* this is namespace, use it in controller to specify views files */);

    //or if we want users to customize our views:
        if ($this->app->runningInConsole()) {
            // Publish views
            $this->publishes([
              __DIR__.'/resources/views' => resource_path('views/vendor/spum'),
            ], 'views');
          
          }
          //of course run this in lrv project to load it
          //php artisan vendor:publish --provider="Smbplus\UserManagement\UserManagementServiceProvider" --tag="views"

          // Publish assets
            $this->publishes([
                __DIR__.'/resources/assets' => public_path('spum'),
            ], 'assets');

            //load it to lrv project (run command in lrv project)
            //php artisan vendor:publish --provider="Smbplus\UserManagement\UserManagementServiceProvider" --tag="assets"

            //use it in html
            //<script src="{{ asset('spum/js/app.js') }}"></script>
            //<link href="{{ asset('spum/css/app.css') }}" rel="stylesheet" />

  }


  protected function registerRoutes()
  {
    Route::group($this->routeConfiguration(), function () {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    });
    
  }

  protected function routeConfiguration()
  {
    return [
        'prefix' => config('smbplus_um.prefix'),
        'middleware' => config('smbplus_um.middleware'),
    ];
  }
}