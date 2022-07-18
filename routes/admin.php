<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PriorityController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\KnowledgeBaseController;
use App\Http\Controllers\Admin\ArticleCommentController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\ReportController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


Route::group([
    'middleware' => ['role:' . User::ROLES['ROLE_ADMIN'] . '|' . User::ROLES['ROLE_AGENT']]
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/comment/{ticket}', [TicketController::class, 'storeComment'])->name('tickets.store.comment');
    Route::resource('reports', ReportController::class)->only(['index']);
});
Route::group(
    [
        'middleware' => ['role:' . User::ROLES['ROLE_ADMIN']]
    ],
    function () {
        Route::resource('comments', CommentController::class)->only(['index', 'destroy']);
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('priorities', PriorityController::class)->except(['show']);
        Route::resource('statuses', StatusController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('departments', DepartmentController::class)->except(['show']);
        Route::get('users/status/{user_id}/{status_code}', [UserController::class, 'updateStatus'])->name('user.status.update');

        Route::resource('knowledges', KnowledgeBaseController::class);
        // Route::resource('questions', QuestionController::class)->except(['show']);

        Route::resource('articlecomments', ArticleCommentController::class)->only(['index', 'destroy']);
        Route::resource('ratings', RatingController::class)->only(['index', 'destroy']);

        Route::get('tickets/merge/{id}', [TicketController::class, 'ticketMerge'])->name('tickets.merge');
        Route::post('tickets/merge', [TicketController::class, 'merge'])->name('tickets.merge.store');
    }
);
