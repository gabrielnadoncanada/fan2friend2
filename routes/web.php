<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\Celebrity\Category;
use App\Http\Livewire\Celebrity\MeetingComponent;
use App\Http\Livewire\Celebrity\Show;
use App\Http\Livewire\Celebrity\WaitingRoomComponent;
use App\Http\Livewire\Contact;
use App\Http\Livewire\Faq;
use App\Http\Livewire\Home;
use App\Http\Livewire\OrderCheckout;
use App\Http\Livewire\OrderSuccess;
use Illuminate\Support\Facades\Route;

Route::middleware('language')->group(function () {
    //    Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('login');
    //    Route::get('/register', \App\Http\Livewire\Auth\Register::class)->name('register');
    //    Route::get('/reset-password', \App\Http\Livewire\Auth\ResetPassword::class)->name('reset-password');
    //
    //    Route::get('/forgot-password', \App\Http\Livewire\Auth\ForgotPassword::class)->name('forgot-password');
    Route::get('/', Home::class)->name('home');
    Route::get('personnalites/{category:slug?}', Category::class)->name('celebrity.index');
    Route::get('personnalites/{category:slug}/{celebrity:slug}', Show::class)->name('celebrity.show');

    Route::get('/faqs', Faq::class)->name('faqs');
    Route::get('/contact', Contact::class)->name('contact');

    Route::middleware('auth')->group(function () {
        Route::get('personnalites/{category:slug}/{celebrity:slug}/waiting-room', WaitingRoomComponent::class)
            ->name('celebrity.waiting-room');
        Route::get('/meeting/{room}/{token}', MeetingComponent::class)
            ->name('celebrity.meeting');

        Route::get('/cart', CartComponent::class)->name('cart');
        Route::get('/checkout', OrderCheckout::class)->middleware('cart.notempty')->name('checkout');
        Route::get('/success/{order}', OrderSuccess::class)->name('order.success')
            ->middleware('order.ispaid');


    });
});

//require __DIR__ . '/auth.php';
