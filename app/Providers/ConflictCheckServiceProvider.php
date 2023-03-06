<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class ConflictCheckServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->bind('conflictCheck', 'App\Services\ConflictCheck');
    }
}
