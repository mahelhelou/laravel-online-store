<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Product;

class ProductController extends Controller {
  // Products data
  /* [
      "id" => "1",
      "name" => "TV",
      "description" => "Best TV",
      "image" => "game.png",
      "price" => "1000"
    ],
    [
      "id" => "2",
      "name" => "iPhone",
      "description" => "Best iPhone",
      "image"  =>  "safe.png",
      "price" => "999"
    ],
    [
      "id" => "3",
      "name" => "Chromecast",
      "description" => "Best Chromecast",
      "image" => "submarine.png",
      "price" => "30"
    ],
    [
      "id" => "4",
      "name" => "Glasses",
      "description" => "Best Glasses",
      "image"  =>  "game.png",
      "price" => "100"
    ]
  ]; */

  // View all products in 'products' page
  public function index() {
    $viewData = [];
    $viewData["title"] = "Products - Online Store";
    $viewData["subtitle"] = "List of products";

    // Static data (Products)
    // $viewData["products"] = ProductController::$products;

    // Getting data from DB
    $viewData['products'] = Product::all();

    return view('product.index')->with("viewData", $viewData);
  }

  // Show product details in 'product' page
  public function show($id) {
    $viewData = [];

    // Static data (Single product)
    // $product = ProductController::$products[$id-1];

    // Getting data from DB (Single product)
    $product = Product::findOrFail($id);

    $viewData["title"] = $product["name"]." - Online Store";
    $viewData["subtitle"] = $product["name"]." - Product information";
    $viewData["product"] = $product;

    return view('product.show')->with("viewData", $viewData);
  }
}