<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function pay(Request $request)
{
    $request->validate([
        'invoice_id' => 'required|exists:invoices,id',
        'phone' => 'required|string',
        'amount' => 'required|numeric',
        'action' => 'required|in:initiate,confirm'
    ]);

    if ($request->action === 'initiate') {
        // Call your STK Push logic
        return back()->with('success', 'STK Push initiated');
    } elseif ($request->action === 'confirm') {
        // Confirm logic if needed
        return back()->with('success', 'Payment confirmed (placeholder)');
    }
}

    private function initiateStkPush(Request $request)
    {
        $timestamp = now()->format('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $timestamp);

        $response = Http::withToken($this->getAccessToken())->post(
            'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
            [
                "BusinessShortCode" => env('MPESA_SHORTCODE'),
                "Password" => $password,
                "Timestamp" => $timestamp,
                "TransactionType" => "CustomerPayBillOnline",
                "Amount" => $request->amount,
                "PartyA" => $request->phone,
                "PartyB" => env('MPESA_SHORTCODE'),
                "PhoneNumber" => $request->phone,
                "CallBackURL" => env('MPESA_CALLBACK_URL'),
                "AccountReference" => "RentInvoice#" . $request->invoice_id,
                "TransactionDesc" => "Tenant Rent Payment"
            ]
        );

        if ($response->successful()) {
            return back()->with('message', 'STK Push sent. Check your phone.');
        }

        return back()->withErrors(['error' => 'Failed to initiate payment.']);
    }

    private function getAccessToken()
    {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withBasicAuth(
            env('MPESA_CONSUMER_KEY'),
            env('MPESA_CONSUMER_SECRET')
        )->get($url);

        return $response['access_token'] ?? null;
    }
}
