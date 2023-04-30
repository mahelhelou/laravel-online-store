# Laravel Online Store

## Online Store App Scope

Let’s define the application scope for the app.

- `Home page`: will display a welcome message and some images.
- `About page`: will display information about the online store and developers.
- `Products page`: will display the available products information. In addition, you can click on a specific product and see its information.
- `Cart page`: will display the products added to the cart and the total price to be paid. In addition, a user can remove products from the cart and make purchases.
- `Login page`: will display a form to allow users to log in to the application.
- `Register page`: will display a form to allow users to sign up for accounts.
- `My orders page`: will display the orders placed by the logged in user.
- `Admin panel`: will contain sections to manage the store’s products (create, update, delete, and list them).

Below is a class diagram illustrating the application scope and design (see Fig. 2-1). We have a User class with its data (id, name, email, password, etc.) which can place Orders . Each Order is composed of one or more Items that are related to a single Product . Each Product will have its corresponding data (id, name, description, image, etc.) (pg 11).

## Installation

1. Install [Xampp](https://www.apachefriends.org/download.html).
2. Install [Composer](https://getcomposer.org/download/).
3. Install Laravel.

```bash
# Get PHP version
php -v || php --version

# Get composer version
composer -v || composer --version

# Install laravel
composer create-project laravel/laravel online-store "8.*" --prefer-dist
```

## Run the Project

```bash
php artisan serve
```

## MVC

`Model-view-controller` (MVC) is a software architectural pattern commonly used to develop web applications containing user interfaces. This pattern divides the application into three interconnected elements.

- `Model` contains the business logic of the application. For example, the Online Store application product data and its functions.
- `View` contains the application’s user interface. For example, a view to register products or users.
- `Controller` acts as an interface between model and view elements. For example, a product controller collects information from a “create product” view and passes it to the product model to be stored in the database.

The `MVC` pattern provides some advantages: better code separation, multiple team members can work and collaborate simultaneously, finding an error is easier, and maintainability is improved.

## About `Blade`

> **TIP:** Do not use plain PHP code in your views. `Blade` allows it, but please do not do it. `Blade` contains a `@php` directive that will enable you to inject plain PHP code. However, only use it as your last resort. We have developed complex Laravel web applications without the use of that directive.

## Create Basic Routes

In `routes/web.php`:

```php
// Route to users - String
Route::get('/users', function() {
    return 'Welcome to Users!';
});

// Route to user - Array (JSON)
Route::get('/users', function() {
    return ['PHP', 'JavaScript', 'React'];
});

// Route to users - JSON
Route::get('/users', function() {
    return response()->json([
        'name'    => 'Mahmoud',
        'course'    => 'Laravel Beginners to Advanced!',
    ]);
});

// Route to users - Function
Route::get('/users', function() {
    // Redirect /users to homepage
    return redirect('/');
});
```

## Create a New Template for Home Page

- In `routes/web.php`:

```php
Route::get('/', function() {
    return view('home');
});
```

- In `resources/views`, create a new file with the name of `home.blade.php`:

```php
<h1>This is the new Home Page Template</h1>
```

## Creating a Controller with View

There're two ways to create controllers, manual way and automatic way.

### 1. Manual Way

- Create a file with the name of `ProductsController.php` inside `app/Http/Controllers`.

```php
// ProductsController.php
namespace app\Http\Controllers;

class ProductsController extends Controller {
    // Code
}
```

### 2. Using Artisan Commands

```bash
# Artisan help
php artisan -h

# Creating a new controller
php artisan make:controller ProductsController

# Override an old controller

php artisan make:controller ProductsController --force
```

## Laravel Routing

Laravel Routing is a mechanism used to route all your application requests to specific methods or functions which will deal with those specific requests. Laravel routes accept a URI (Uniform Resource Identifier) along with a closure. Closures are PHP’s version of anonymous functions. A closure is a funct

## Introducing Laravel Controllers

Defining all your request handling logic inside in your route files’ closures does not seem smart. You will end with hundreds or thousands of code lines inside the route files (which affects the project maintainability). A good strategy is to organize this behavior using “controller” classes. Controllers can group related request handling logic into a single class. For example, a `UserController` class might handle all incoming requests related to users, including showing, creating, updating, and deleting users.
