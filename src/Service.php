<?php
namespace gumphp\filesystem;

class Service extends \think\Service
{
    public function register(): void
    {
        $this->app->bind(\think\Filesystem::class, function () {
            return invoke(\gumphp\filesystem\Filesystem::class);
        });
    }

    public function boot(): void
    {

    }
}