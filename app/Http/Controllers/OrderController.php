<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $consumerKey = env('WC_CONSUMER_KEY');
        $consumerSecret = env('WC_CONSUMER_SECRET');
        $siteUrl = env('WC_SITE_URL');

        $orders = [];
        $perPage = 100; // Number of orders per page
        $page = 1;

        do {
            $response = Http::withBasicAuth($consumerKey, $consumerSecret)
                ->get("$siteUrl/wp-json/wc/v3/orders", [
                    'per_page' => $perPage,
                    'page' => $page,
                ]);

            $fetchedOrders = $response->json();
            $orders = array_merge($orders, $fetchedOrders);
            $page++;
        } while (count($fetchedOrders) === $perPage);

        return view('welcome', compact('orders'));
    }
}
