<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SMSCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('📩 SMS DELIVERY CALLBACK:', $request->all());
        return response()->json(['status' => 'received']);
    }
}
