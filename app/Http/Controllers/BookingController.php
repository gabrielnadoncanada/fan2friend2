<?php

namespace App\Http\Controllers;

// app/Http/Controllers/BookingController.php

namespace App\Http\Controllers;

use App\Services\PaymentGateways\StripePaymentGateway;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $stripe;

    public function __construct(StripePaymentGateway $stripe)
    {
        $this->stripe = $stripe;
    }

    public function show()
    {
        return view('booking');
    }

    public function book(Request $request)
    {
        // Validate your request
        $validated = $request->validate([
            'token' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Handle the charging
        try {
            $charge = $this->stripe->charge($validated['amount'], ['token' => $validated['token']]);

            // Save the booking to database or any other business logic

            return response()->json(['message' => 'Payment successful', 'data' => $charge]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function refund(Request $request)
    {

        $validated = $request->validate([
            'transactionId' => 'required',
            'amount' => 'required'
        ]);

        try {
            $refundData = $this->stripe->refund('ch_3O1ZuEBveDBUOoxc0RNUO4nY', $validated['amount']);

            // Assuming the refund method of the StripePaymentGateway service will
            // return refund details, you can store them in your database

            return response()->json(['message' => 'Refund successful', 'data' => $refundData]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
