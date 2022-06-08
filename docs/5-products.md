# Products

> **TIP:** In the last examples, we have defined a structure to store our controllers, controllers’ methods, routes’ names, and views. For example, the product.show route is linked to the ProductController show method, which displays the product/show view. Try to use this strategy across the entire project as it facilitates finding the views of the corresponding controllers’ methods and vice versa.

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

- Replace the `ProductController::$products` with the `Product` model.
- The model is called to connect to the database and get the data.
- We remove the products dummy attribute since we don’t need it anymore. We will instead retrieve the products data from the database.

```php
use App\Models\Product;

class ProductController extends Controller {
  // Products data (Replaced with products from database)
  // $products = [... ];

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

    $viewData["title"] = $product["name"] . " - Online Store";
    $viewData["subtitle"] = $product["name"] . " - Product information";
    $viewData["product"] = $product;

    return view('product.show')->with("viewData", $viewData);
  }
}
```

## Refactoring Products List

Many things can be improved in the previous code. For example, we will refactor our `Product model`, `ProductController` , and `product views`. These changes will make our code more maintainable, understandable, and clean.

### Add Model Attributes

- In the initial `Product Model` file, there's no way to know the produce model attributes unsless we open `create product table` migrations or open `phpMyAdmin`! The way the model is designed affects the project's understandability.

### Refactor Product Model

- We have declared the model’s attributes in the form of `$this->attributes['id']`. It is because Laravel Eloquent stores the model’s attributes in a class array attribute called `$attributes`.
- Laravel Eloquent provides two ways of accessing model attributes. The object attribute form `($product->name)` and the associative array form `($product["name"])`.

```php
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * PRODUCT ATTRIBUTES
 * $this->attributes['id'] - int - contains the product primary key (id)
 * $this->attributes['name'] - string - contains the product name
 * $this->attributes['description'] - string - contains the product description
 * $this->attributes['image'] - string - contains the product image
 * $this->attributes['price'] - int - contains the product price
 * $this->attributes['created_at'] - timestamp - contains the product creation date
 * $this->attributes['updated_at'] - timestamp - contains the product update date
 */
```

### Project Without Getters and Setters

- Look at the `show` method in `ProductController.php`:

```php
public function show($id) {
  $viewData = [];
  $product = Product::findOrFail($id);
  $viewData["title"] = $product["name"]." - Online Store";
  $viewData["subtitle"] = $product["name"]." - Product information";
  $viewData["product"] = $product;
}
```

- And look at the `show` method in `product.show`:

```php
<div class="card-body">
  <h5 class="card-title">
  {{ $viewData["product"]["name"] }} (${{ $viewData["product"]["price"] }})
  </h5>
  <p class="card-text">{{ $viewData["product"]["description"] }}</p>
  <p class="card-text"><small class="text-muted">Add to Cart</small></p>
  </div>
```

### What's the Problem with the Product Code (Without Getters and Setters)?

Imagine that your boss tells you, “We need to display all products’ names in uppercase throughout the entire application”. That is a big issue as we extract products’ names over several different views and controllers.

With this problem, we've to modify the code in the following files:

- Modify the `ProductController`:

```php
public function show($id) {
  $viewData = [];
  $product = Product::findOrFail($id);
  $viewData["title"] = strtoupper($product["name"]) . " - Online Store";
  $viewData["subtitle"] = strtoupper($product["name"]) . " - Product information";
  $viewData["product"] = $product;
}
```

- Modify the `product.show`:

```php
<div class="card-body">
  <h5 class="card-title">
  {{ strtoupper($viewData["product"]["name"]) }} (${{ $viewData["product"]["price"] }})
  </h5>
  <p class="card-text">{{ $viewData["product"]["description"] }}</p>
  <p class="card-text"><small class="text-muted">Add to Cart</small></p>
</div>
```

### Project With Getters and Setters

- Refactoring the `Product Model`:
- For each Product attribute, we define its corresponding getter and setter. We will use getters and setters to access and modify our model attributes.

```php
<?php

namespace App\Models;

/**
 * HasFactory is used to automate the migration process (Out of the book's scope)
 */
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	// use HasFactory;

	/**
	 * PRODUCT ATTRIBUTES
	 * $this->attributes['id'] - int - contains the product primary key (id)
	 * $this->attributes['name'] - string - contains the product name
	 * $this->attributes['description'] - string - contains the product description
	 * $this->attributes['image'] - string - contains the product image
	 * $this->attributes['price'] - int - contains the product price
	 * $this->attributes['created_at'] - timestamp - contains the product creation date
	 * $this->attributes['updated_at'] - timestamp - contains the product update date
	 */

	public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice()
    {
        return $this->attributes['price'];
    }

    public function setPrice($price)
    {
        $this->attributes['price'] = $price;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
```

- Refactoring the `ProductController`:

```php
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

  /**
   * View all products in 'products' page
   * The index method gets the array of products and sends them to the product.index view to be displayed.
   */
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

    // $viewData["title"] = $product["name"] . " - Online Store";
    // $viewData["subtitle"] = $product["name"] . " - Product information";

    // Getting product's name through getters
    $viewData["title"] = $product->getName() . " - Online Store";
    $viewData["subtitle"] = $product->getName() . " - Product information";

    return view('product.show')->with("viewData", $viewData);
  }
}
```

- Refactoring the `product.index`:

```php
// Replace this
<a href="{{ route('product.show', ['id' => $product['id']]) }}" class="btn bg-primary text-white">{{ $product["name"] }}</a>

// With this (Comes from Product Model)
<a href="{{ route('product.show', ['id' => $product->getId()]) }}"
class="btn bg-primary text-white">{{ $product->getName() }}</a>
```

- Refactoring the `product.show`:

```php
// Replace this
<img src="{{ asset('/images/' . $viewData['product']['image']) }}" class="img-fluid rounded-start">

// With this
<img src="{{ asset('/images/' . $viewData['product']->getImage()) }}" class="img-fluid rounded-start">

// Replace this
<h5 class="card-title">{{ $viewData['product']['name'] }} (${{ $viewData['product']['price'] }})</h5>

// With this
<h5 class="card-title">{{ $viewData["product"]->getName() }} (${{ $viewData["product"]->getPrice() }})</h5>

// Replace this
<p class="card-text">{{ $viewData['product']['description'] }}</p>
<p class="card-text"><small class="text-muted">Add to Cart</small></p>

// With this
<p class="card-text">{{ $viewData["product"]->getDescription() }}</p>
<p class="card-text"><small class="text-muted">Add to Cart</small></p>
```

### The Benefits of Using Getters and Setters

Now, if the boss wants to change the product's name to uppercase, in this case, we only need to modify the Product model file:

```php
public function getName() {
  return strtoupper($this->attributes['name']);
}
```

## List Products in Admin Panel