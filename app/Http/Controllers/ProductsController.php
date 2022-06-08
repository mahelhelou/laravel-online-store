<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller {

    // Index method
    public function index() {
        return view('products.index');
    }

    // About method
    public function about() {
        return 'About Us';
    }
}