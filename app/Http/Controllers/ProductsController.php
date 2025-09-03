<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // This query fetches products with a price greater than 100 from the database.
            $products = DB::table('products')->where('price', '>', '100')->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // Log the error and return an empty array or a specific error message.
            \Log::error('Database error fetching products: ' . $e->getMessage());
            $products = [];
        }

        // Return the products.index view and pass the $products data to it.
        return view('products.index', compact('products'));
    }
}
