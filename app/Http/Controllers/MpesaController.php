<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MpesaController extends Controller
{
    public function stkPush(Request $request)
    {
        // Generate access token.
        $accessToken = $this->generateAccessToken();
    
        // Generate a timestamp in the required format.
        $timestamp = date('YmdHis');
    
        // Combine the shortcode, passkey, and timestamp and then base64 encode.
        $password = base64_encode(
            env('MPESA_SHORTCODE') .
            env('MPESA_PASSKEY') .
            $timestamp
        );
    
        // Prepare the payload for the STK Push request.
        $payload = [
            "BusinessShortCode" => env('MPESA_SHORTCODE'),
            "Password"          => $password,
            "Timestamp"         => $timestamp,
            "TransactionType"   => "CustomerPayBillOnline",
            "Amount"            => 1, // Use a whole number as required.
            "PartyA"            => $request->phone, // Must be in 2547XXXXXXXX format.
            "PartyB"            => env('MPESA_SHORTCODE'),
            "PhoneNumber"       => $request->phone, // Same as PartyA.
            "CallBackURL"       => env('MPESA_CALLBACK_URL'),
            "AccountReference"  => "Test", // Reference for your transaction.
            "TransactionDesc"   => "Test Payment"
        ];
    
        // Send the POST request to Safaricom.
        $response = Http::withToken($accessToken)
    ->withHeaders([
        'Content-Type' => 'application/json'
    ])
    ->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', $payload);
    
        // Return the response as JSON.
        return response()->json($response->json());
    }
    
    public function generateAccessToken()
    {
        $credentials = base64_encode(
            env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET')
        );
    
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials
        ])->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    
        return $response['access_token'];
    }

    public function mpesaCallback(Request $request)
    {
        \Log::info('MPESA CALLBACK:', $request->all());

        return response()->json(['message' => 'Callback received']);
    }
}