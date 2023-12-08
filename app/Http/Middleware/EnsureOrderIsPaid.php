<?php

namespace App\Http\Middleware;

use App\Enums\OrderStatus;
use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureOrderIsPaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orderId = $request->route('order'); // Assuming 'order' is the route parameter name
        $order = Order::find($orderId);

        if (! $order || $order->user_id !== Auth::id() || ! $order->status == OrderStatus::PAID) {
            // Redirect to a desired location or show an error message
            return redirect()->route('home');
        }

        return $next($request);
    }
}
