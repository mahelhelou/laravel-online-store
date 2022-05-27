# Laravel Documentation for This Project

## Run the Project

```bash
php artisan serve
```

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

## MVC

`Model-view-controller` (MVC) is a software architectural pattern commonly used to develop web applications containing user interfaces. This pattern divides the application into three interconnected elements.

- `Model` contains the business logic of the application. For example, the Online Store application product data and its functions.
- `View` contains the application’s user interface. For example, a view to register products or users.
- `Controller` acts as an interface between model and view elements. For example, a product controller collects information from a “create product” view and passes it to the product model to be stored in the database.

The `MVC` pattern provides some advantages: better code separation, multiple team members can work and collaborate simultaneously, finding an error is easier, and maintainability is improved.

## Laravel Routing

Laravel Routing is a mechanism used to route all your application requests to specific methods or functions which will deal with those specific requests. Laravel routes accept a URI (Uniform Resource Identifier) along with a closure. Closures are PHP’s version of anonymous functions. A closure is a funct

## Introducing Laravel Controllers

Defining all your request handling logic inside in your route files’ closures does not seem smart. You will end with hundreds or thousands of code lines inside the route files (which affects the project maintainability). A good strategy is to organize this behavior using “controller” classes. Controllers can group related request handling logic
into a single class. For example, a `UserController` class might handle all incoming requests related to users, including showing, creating, updating, and deleting users.
