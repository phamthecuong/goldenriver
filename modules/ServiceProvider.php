<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 11/07/2018 03:22 PM
 */

namespace Modules;



use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(){
        /*$modules = config('modules');

        foreach ($modules as $module) {
            if(file_exists($route = __DIR__.'/'.$module.'/routes.php')) {
                $this->loadRoutesFrom($route);
            }
            
            if(is_dir(__DIR__.'/'.$module.'/views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/views', $module);
            }

            if (is_dir( $migrate = __DIR__.'/'.$module.'/migrations')) {
                $this->loadMigrationsFrom($migrate);
            }
        }*/
    }

    public function register(){
        $modules = config('modules');

        foreach ($modules as $module => $provider) {
            $moduleDir =  __DIR__ . '/' . $module;

            if(!file_exists($fileProvider = $moduleDir . '/ServiceProvider.php')) {
                throw new \Exception('ServiceProvider.php not found in module ' . $provider);
            }

            $this->app->register($provider);
        }
    }


}