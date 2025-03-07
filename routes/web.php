<?php

use Illuminate\Support\Facades\Route;
use RestCord\DiscordClient;
use App\Http\Controllers\Panel\CharacterSlotsController;
use App\Http\Controllers\Panel\PaymentController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     $t = \App\Models\Transaction::with('user')->find(1325);
//     dd($t);
// });

Route::group(['middleware'=>['auth'] ] , function (){
    Route::get('dashboard' , [\App\Http\Controllers\Panel\MainController::class , 'dashboard'])->name('dashbaord');
    Route::get('history' , [\App\Http\Controllers\Panel\MainController::class , 'history'])->name('history');
    Route::get('back-history' , [\App\Http\Controllers\Panel\MainController::class , 'backHistory'])->name('backHistory');
    Route::get('subscribe/{tire}' , [\App\Http\Controllers\Panel\MainController::class , 'buy'])->name('buy');
    Route::get('donate' , [\App\Http\Controllers\Panel\MainController::class , 'donate'])->name('donate');
    Route::post('donate' , [\App\Http\Controllers\Panel\MainController::class , 'payDonate'])->name('payDonate');
    Route::get('verify/{transaction}' , [\App\Http\Controllers\Panel\MainController::class , 'callback'])->name('callback');
    Route::get('get-rolls' , [\App\Http\Controllers\Panel\MainController::class , 'getRoll'])->name('getRoll');
    Route::get('/character-slots', [CharacterSlotsController::class, 'index'])->name('character.slots');
    Route::post('/buy-slots', [CharacterSlotsController::class, 'buySlots'])->name('buy.slots');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/callback/{transaction}', [PaymentController::class, 'paymentCallback'])->name('payment.callback');
});

Route::get('/upgradeToAdmin/{user}' , [\App\Http\Controllers\Panel\MainController::class,'setAsAdmin'])->middleware('dynamicAcl')->name('upgradeToAdmin');
