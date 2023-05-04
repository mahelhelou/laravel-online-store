<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Product;

class ProductController extends Controller {
  // Products data
  /* public static $products = [
    [
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

  /**
   * View all products in 'products' page
   * The index method gets the array of products and sends them to the product.index view to be displayed.
   */
  public function index() {
    $viewData = [
			'title' => 'Products - Online Store',
			'subtitle' => 'List of products',

			// Static data (Products)
			// 'products' => ProductController::$products,

			// Getting data from DB
			'products' => Product::all(),
		];



    return view('product.index')->with("viewData", $viewData);
  }

  // Single product view
  public function show($id) {
		/**
		 * $products used to retrieve a product resource based on its (id).
		 * The first $product variable is from $products array in `index` method.
		 * The second $product uses `Product` model to retrieve the product resource from DB.
		 */

    // $product = ProductController::$products[$id-1];
    $product = Product::findOrFail($id);

    $viewData = [
			'title' => $product["name"] . " - Online Store",
			'subtitle' => $product["name"] . " - Product information",
			'product' => $product
		];

    return view('product.show')->with("viewData", $viewData);
  }
}