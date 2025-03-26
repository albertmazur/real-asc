<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\SubmissionController;

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

Route::get('/', [EventController::class, 'welcome'])->name('home');
Route::get('/lang/{lang}', [HomeController::class, 'changeLanguage'])->name('lang.switch');

Route::group([
    'prefix' => 'event',
    'namespace' => 'event',
    'as' => 'event.'
], function (){
    Route::get('index', [EventController::class, 'index'])->name('index');
    Route::get('show/{eventId}', [EventController::class, 'show'])->name('show')->whereNumber('eventId');
});

Route::group([
    'prefix' => 'submission',
    'namespace' => 'submission',
    'as' => 'submission.'
], function (){
    Route::post('store', [SubmissionController::class, 'store'])->name('store');
});

Route::middleware(['auth', 'verified'])->group(function (){
    Route::group([
        'prefix' => 'event',
        'namespace' => 'event',
        'as' => 'event.'
    ], function (){
        Route::get('dashboard', [EventController::class, 'dashboard'])->name('dashboard');
        Route::get('edit/{eventId}', [EventController::class, 'edit'])->name('edit')->whereNumber('eventId');
        Route::post('store', [EventController::class, 'store'])->name('store');
        Route::put('update', [EventController::class, 'update'])->name('update');
    });

    Route::group([
        'prefix' => 'submission',
        'namespace' => 'submission',
        'as' => 'submission.'
    ], function (){
        Route::get('index', [SubmissionController::class, 'index'])->name('index');
        Route::delete('remove', [SubmissionController::class, 'destroy'])->name('remove');
    });


    Route::group([
        'prefix' => 'ticket',
        'namespace' => 'ticket',
        'as' => 'ticket.'
    ], function (){
        Route::get('index', [TicketController::class, 'index'])->name('index');
        Route::post('store', [TicketController::class, 'store'])->name('store');
        Route::get('history', [TicketController::class, 'history'])->name('history');
        Route::put('back', [TicketController::class, 'backTicket'])->name('back');
        Route::get('payment-status', [TicketController::class, 'paymentStatus'])->name('payment.status');
    });

    Route::group([
        'prefix' => 'stadium',
        'namespace' => 'stadium',
        'as' => 'stadium.'
    ], function (){
        Route::get('index', [StadiumController::class, 'index'])->name('index');
        Route::post('store', [StadiumController::class, 'store'])->name('store');
        Route::get('{stadiumId}', [StadiumController::class, 'edit'])->name('edit');
        Route::put('update', [StadiumController::class, 'update'])->name('update');
    });

    Route::group([
        'prefix' => 'comment',
        'namespace' => 'comment',
        'as' => 'comment.'
    ], function (){
        Route::get('index', [CommentController::class, 'index'])->name('index');
        Route::post('store', [CommentController::class, 'store'])->name('store');
        Route::delete('remove', [CommentController::class, 'destroy'])->name('remove');
        Route::get('my', [CommentController::class, 'myComments'])->name('my');
    });

    Route::group([
        'prefix' => 'home',
        'namespace' => 'home',
        'as' => 'home.'
    ], function (){
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    });
});

Auth::routes(['verify' => true]);
