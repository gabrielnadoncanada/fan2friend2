<?php

use App\Http\Controllers\BookingController;
use App\Livewire\Form;
use App\Livewire\Cart;
use App\Livewire\Home;
use App\Livewire\Celebrity;
use Illuminate\Support\Facades\Route;
Route::get('form', Form::class);

Route::get('/', Home::class)->name('home');
Route::prefix('personnalites')->group(function () {
    Route::get('/{category:slug?}', Celebrity\Category::class)->name('celebrity.index');
    Route::get('/{category:slug}/{celebrity:slug}', Celebrity\Show::class)->name('celebrity.show');
});
Route::get('/panier', Cart::class)->name('cart');
Route::post('/book', [BookingController::class, 'book']);
Route::get('/booking', [BookingController::class, 'show']);
Route::post('/refund', [BookingController::class, 'refund']);

