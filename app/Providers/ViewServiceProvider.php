<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\KnowledgeBase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\TicketComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['frontend.home'],
            TicketComposer::class
        );
        view()->share('latest_articles', KnowledgeBase::latest()->limit(5)->get());
    }
}
