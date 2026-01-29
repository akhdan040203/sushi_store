<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        
        $menuProducts = Product::where('is_active', true)
            ->with('category')
            ->take(10)
            ->get();

        // Get Signature Products for the slider
        $featuredProducts = Product::where('is_active', true)->where('is_signature', true)->get();
        
        // If no signature products are set, fallback to most recent active products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::where('is_active', true)->latest()->take(6)->get();
        }

        return view('welcome', compact('categories', 'menuProducts', 'featuredProducts'));
    }
}
