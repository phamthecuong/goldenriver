<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/17/2019 04:15 PM
 */

namespace Modules\template;


use Illuminate\Support\Facades\Route;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $module = 'template';
    protected $namespace = __NAMESPACE__;
    protected $route = 'routes.php';

    public function boot()
    {

    }

    public function register()
    {
        $this->mapWebRoutes();

        if(is_dir($views = __DIR__. '/views')) {
            $this->loadViewsFrom($views, 'template');
        }

        if (is_dir($migrate =  __DIR__.  '/migrations')) {
            $this->loadMigrationsFrom($migrate);
        }
    }

    protected function mapWebRoutes()
    {
        $route = __DIR__ . '/' . $this->route;

        if (!file_exists($route)) {
            return null;
        }

        Route::middleware('web')
            ->namespace($this->namespace . '\controllers')
            ->group($route);
    }
}