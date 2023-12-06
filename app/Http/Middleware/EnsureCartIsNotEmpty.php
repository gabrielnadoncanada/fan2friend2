<?php

namespace App\Http\Middleware;

use App\Facades\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCartIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cart::isEmpty()) {
            // Redirect to the cart page or another appropriate page
            return redirect('/cart')->with('message', 'Your cart is empty!');
        }

        return $next($request);
    }
}
