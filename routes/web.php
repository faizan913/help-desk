<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontEnd\TicketController;
use App\Http\Controllers\FrontEnd\KnowledgeBaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);


Route::group(
    [
        'middleware' => ['auth', 'role:' . User::ROLES['ROLE_USER']]
    ],
    function () {
        Route::get('home', [TicketController::class, 'home'])->name('home');
        Route::get('list', [TicketController::class, 'index'])->name('ticket.list');
        Route::get('list/open', [TicketController::class, 'openTickets'])->name('ticket.open');
        Route::get('list/close', [TicketController::class, 'closeTickets'])->name('ticket.close');

        Route::get('create', [TicketController::class, 'create'])->name('ticket.create');
        Route::post('ticket', [TicketController::class, 'store'])->name('ticket.post');
        Route::get('ticket/{id}', [TicketController::class, 'show'])->name('show.tickets');

        /* Knowledge base routes */
        Route::get('knowledge/base', [KnowledgeBaseController::class, 'knowledgeBase'])->name('knowledge.tickets');
        Route::get('knowledge/detail/{id}', [KnowledgeBaseController::class, 'knowledgeDetail'])->name('knowledge.detail');

        Route::post('knowledges/comment', [KnowledgeBaseController::class, 'storeComment'])->name('knowledges.store.comment');

        Route::post('storeRating', [TicketController::class, 'storeRating'])->name('store.rating');
        Route::post('storeCommentRating', [TicketController::class, 'storeCommentRating'])->name('store.comment.rating');
        Route::post('store/comment/{id}', [TicketController::class, 'storeComment'])->name('store.comment');
    }
);
