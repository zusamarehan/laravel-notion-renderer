<?php

namespace RehanKanak\LaravelNotionRenderer;

use Illuminate\Support\ServiceProvider;

class NotionRendererServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/notion-renderer.php' => config_path('notion-renderer.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/notion-renderer.php', 'notion-renderer');
    }
}
