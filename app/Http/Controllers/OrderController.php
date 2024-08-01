<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $consumerKey = env('WC_CONSUMER_KEY');
        $consumerSecret = env('WC_CONSUMER_SECRET');
        $siteUrl = env('WC_SITE_URL');

        $perPage = 30; // Number of orders per page
        $page = $request->get('page', 1); // Get the current page or default to 1

        $response = Http::withBasicAuth($consumerKey, $consumerSecret)
            ->get("$siteUrl/wp-json/wc/v3/orders", [
                'per_page' => $perPage,
                'page' => $page,
            ]);

        $orders = $response->json();
        $total = $response->header('X-WP-Total'); // Total number of orders

        // Create a paginator instance
        $orders = new LengthAwarePaginator(
            $orders,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('dashboard', compact('orders'));
    }
}


