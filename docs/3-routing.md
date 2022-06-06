# Laravel Routing

Laravel Routing is a mechanism used to route all your application requests to specific methods or functions which will deal with those specific requests.

## Create Basic Routes

- In `routes/web.php, create a new route:

```php
Route::get('/', function () {
  $viewData = [];
  $viewData["title"] = "Home Page - Online Store";
  return view('home.index')->with("viewData", $viewData);
});

Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about");
```

In the above code, we presented two ways of defining Laravel routes:

- The first route connects the `/` URI with a closure that returns a view (in this case, the home.index view). `view()` is a Laravel helper which retrieves a view instance. Check how we pass the `viewData` variable to the home.index view by chaining the with method onto the view helper method.
- The second route connects the `/about` URI with the HomeController about method. Besides, we define a custom route name by chaining the name method onto the route definition.

## Cleanup Routes

- Instead of defining the logic inside the route closure, we can define the logic inside a controller.
- Create `HomeController` inside `app/Http/Controllers`. (Look at [HomeContollder](4-controllers.md))

```php
// Import HomeController class
use App\Http\Controllers\HomeController;

// Refactoring routes (Cleaner)
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
```
