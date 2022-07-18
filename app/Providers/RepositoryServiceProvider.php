<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\Eloquent\RatingRepository;
use App\Repositories\Eloquent\StatusRepository;
use App\Repositories\Eloquent\TicketRepository;
use App\Repositories\RatingRepositoryInterface;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\TicketRepositoryInterface;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\ServiceRepository;
use App\Repositories\ServiceRepositoryInterface;
use App\Repositories\Eloquent\PriorityRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\PriorityRepositoryInterface;
use App\Repositories\Eloquent\KnowledgeRepository;
use App\Repositories\KnowledgeRepositoryInterface;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\Eloquent\DepartmentRepository;
use App\Repositories\ArticleCommentRepositoryInterface;
use App\Repositories\Eloquent\ArticleCommentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(PriorityRepositoryInterface::class, PriorityRepository::class);
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);

        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);

        $this->app->bind(KnowledgeRepositoryInterface::class, KnowledgeRepository::class);
        $this->app->bind(ArticleCommentRepositoryInterface::class, ArticleCommentRepository::class);
        $this->app->bind(RatingRepositoryInterface::class, RatingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
