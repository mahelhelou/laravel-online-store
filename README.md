# Laravel Online Store

## References

- [DB: Available Column Types](https://laravel.com/docs/9.x/migrations#available-column-types)
- [DB: Laravel Eloquent](https://laravel.com/docs/9.x/eloquent)
- [Model: Accessors and Mutators](https://laravel.com/docs/9.x/eloquent-mutators#accessors-and-mutators)
- [CSRF Attacks](https://owasp.org/www-community/attacks/csrf)
- [Request: Validation Rules](https://laravel.com/docs/9.x/validation#available-validation-rules)
- [Validation](https://laravel.com/docs/9.x/validation)

## Online Store App Scope

> Look at page 11 to see the class diagram for the scope.

- `Home page`: Will display a welcome message and some images.
- `About page`: Will display information about the online store and developers.
- `Products page`: Will display the available products information. In addition, you can click on a specific product and see its information.
- `Cart page`: Will display the products added to the cart and the total price to be paid. In addition, a user can remove products from the cart and make purchases.
- `Login page`: Will display a form to allow users to log in to the application.
- `Register page`: Will display a form to allow users to sign up for accounts.
- `My orders page`: Will display the orders placed by the logged in user.
- `Admin panel`: Will contain sections to manage the store’s products (create, update, delete, and list them).

## MVC

`Model-view-controller` (MVC) is a software architectural pattern commonly used to develop web applications containing user interfaces. This pattern divides the application into three interconnected elements.

- `Model` contains the business logic of the application. For example, the Online Store application product data and its functions.
- `View` contains the application’s user interface. For example, a view to register products or users.
- `Controller` acts as an interface between model and view elements. For example, a product controller collects information from a “create product” view and passes it to the product model to be stored in the database.

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

Laravel Routing is a mechanism used to route all your application requests to specific methods or functions which will deal with those specific requests. Laravel routes accept a URI (Uniform Resource Identifier) along with a closure. Closures are PHP’s version of anonymous functions. A closure is a function you can pass around as an object, assign to a variable, or pass as a parameter to other functions and methods.

### Routes Links

You can link the `<a href="#"></a>` to specific routes using 3 ways:

```php
// 1. Using named routes (Recommended, best practice)
<a href="{{ route('about') }}">About</a>

// 2. Using url(), no need to name the route
<a href="{{ url('/about') }}">About</a>

// 3. Using asset(), if the file is local
<a href="{{ asset('about.html') }}">About</a>
```

## Laravel Controllers

Defining all your request handling logic inside in your route files’ closures does not seem smart. You will end with hundreds or thousands of code lines inside the route files (which affects the project maintainability). A good strategy is to organize this behavior using “controller” classes. Controllers can group related request handling logic into a single class. For example, a `UserController` class might handle all incoming requests related to users, including showing, creating, updating, and deleting users.
