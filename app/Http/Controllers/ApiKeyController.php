<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiKey;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function index()
    {
        // $orders = Order::paginate(10); // Assuming you have an Order model and you want to paginate orders
        $apiKeys = ApiKey::all();
        return view('dashboard', compact('apiKeys'));
    }

    public function generate()
    {
        $apiKey = Str::random(32);
        $secret = Str::random(64);

        ApiKey::create([
            'api_key' => $apiKey,
            'secret' => $secret,
        ]);

        return redirect()->route('dashboard')->with('success', 'API key generated successfully.');
    }

    
};
