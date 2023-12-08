<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\Celebrity\Category;
use App\Http\Livewire\Celebrity\MeetingComponent;
use App\Http\Livewire\Celebrity\Show;
use App\Http\Livewire\Celebrity\WaitingRoomComponent;
use App\Http\Livewire\Contact;
use App\Http\Livewire\Home;
use App\Http\Livewire\OrderCheckout;
use App\Http\Livewire\OrderSuccess;
use Illuminate\Support\Facades\Route;

Route::middleware('language')->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/register', \App\Http\Livewire\Auth\Register::class)->name('register');
    Route::get('personnalites/{category:slug?}', Category::class)->name('celebrity.index');
    Route::get('personnalites/{category:slug}/{celebrity:slug}', Show::class)->name('celebrity.show');

    Route::view('/faq', 'page', ['page' => 'faq'])->name('faqs');
    Route::view('/policy', 'page', ['page' => 'policy'])->name('policy');
    Route::view('/refund', 'page', ['page' => 'refund'])->name('refund');
    Route::view('/term', 'page', ['page' => 'term'])->name('term');

    Route::get('/contact', Contact::class)->name('contact');

    Route::middleware('auth')->group(function () {
        Route::get('personnalites/{category:slug}/{celebrity:slug}/waiting-room', WaitingRoomComponent::class)
            ->name('celebrity.waiting-room');
        Route::get('/meeting/{celebrity}/{token}', MeetingComponent::class)
            ->name('celebrity.meeting');

        Route::get('/cart', CartComponent::class)->name('cart');
        Route::get('/checkout', OrderCheckout::class)->middleware('cart.notempty')->name('checkout');
        Route::get('/success/{order}', OrderSuccess::class)->name('order.success')
            ->middleware('order.ispaid');

    });
});

//require __DIR__ . '/auth.php';
