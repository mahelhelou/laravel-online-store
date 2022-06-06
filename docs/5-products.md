# Products

## List Products From Dummy Data (Static Products Data)

### Creating the Routes

```php
use App\Http\Controllers\ProductController;

// Products routes
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
```

### Creating the Controller

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Product;

class ProductController extends Controller {
  // Products data
  public static $products = [
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
  ];

  // View all products in 'products' page
  public function index() {
    $viewData = [];
    $viewData["title"] = "Products - Online Store";
    $viewData["subtitle"] = "List of products";

    // Static data (Products)
    $viewData["products"] = ProductController::$products;

    return view('product.index')->with("viewData", $viewData);
  }

  // Show product details in 'product' page
  public function show($id) {
    $viewData = [];

    // Static data (Single product)
    $product = ProductController::$products[$id-1];

    $viewData["title"] = $product["name"] . " - Online Store";
    $viewData["subtitle"] = $product["name"] . " - Product information";
    $viewData["product"] = $product;

    return view('product.show')->with("viewData", $viewData);
  }
}
```

### Creating the View

- `product.index` view:

```php
@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
  @foreach ($viewData["products"] as $product)
  <div class="col-md-4 col-lg-3 mb-2">
    <div class="card">
      <img src="{{ asset('/images/' . $product['image']) }}" class="card-img-top img-card">
      <div class="card-body text-center">
                <a href="{{ route('product.show', ['id' => $product['id']]) }}" class="btn bg-primary text-white">{{
          $product["name"] }}</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
```

> **Note:** You can pass the `product_id` as an array in the route in the view file.

- `product.show` view:

```php
@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ asset('/images/' . $viewData['product']['image']) }}" class="img-fluid rounded-start">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">
          {{ $viewData['product']['name'] }} (${{ $viewData['product']['price'] }})
        </h5>
        <p class="card-text">{{ $viewData['product']['description'] }}</p>
        <p class="card-text"><small class="text-muted">Add to Cart</small></p>
      </div>
    </div>
  </div>
</div>
@endsection
```

## List Products From Database
