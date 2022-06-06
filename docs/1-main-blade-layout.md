# Create Main Blade Layout

## Define the Main Blade Layout

- In `resources/views/layouts` create a file named `app.blade.php`:

```php
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href={{ asset('css/app.css') }}>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <title>@yield('title', 'Online Store')</title>
</head>

<body>
  <!-- header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home.index') }}">Online Store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" href="{{ route('home.index') }}">Home</a>
          <a class="nav-link active" href="{{ route('product.index') }}">Products</a>
          <a class="nav-link active" href="{{ route('home.about') }}">About</a>
        </div>
      </div>
    </div>
  </nav>
  <header class="masthead bg-primary text-white text-center py-4">
    <div class="container d-flex align-items-center flex-column">
      <h2>@yield('subtitle', 'A Laravel Online Store')</h2>
    </div>
  </header>
  <!-- header -->
  <div class="container my-4">
    @yield('content')
  </div>

  <!-- footer -->
  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <small>
        Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
          href="https://twitter.com/danielgarax">
          Daniel Correa
        </a> - <b>Paola Vallejo</b>
      </small>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
</body>
</html>
```

`@yield` is used as a marker. We will inject code in those markers from child Blade views (using the `@section` directive). `@yield` uses two parameters, the first is the marker identifier. The second is a default value that will be injected if a child view does not inject code for that marker.

We've include 3 `Balde` directives:

- `@yield('title', 'Online Store')`: Used to inject the page title of the child blade.
- `@yield('subtitle', 'A Laravel Online Store')`: Used to inject the masthead title.
- `@yield('subtitle')`: Used to inject the child blade content.

## Edit the Welcome Blade View

- Remove everything in the file, and replace it with the following code:

```php
@extends('layouts.app')
@section('title', 'Home Page - Online Store')
@section('content')
  <div class="text-center">
    Welcome to the application
  </div>
@endsection
```

## Edit Navigation Links

We use the `route` helper method in the previous layout, which generates a URL for a given named route. We used the names of the routes defined for the (“/”) route `(home.index)` and the (“/about”) route `(home.about)`.

## Include a Custom CSS File

- Create a CSS file in the `public/css` directory named `app.css`:

```css
.bg-secondary {
	background-color: #2c3e50 !important;
}

.copyright {
	background-color: #1a252f;
}

.bg-primary {
	background-color: #1abc9c !important;
}

nav {
	font-weight: 700;
}

.img-card {
	height: 18vw;
	object-fit: cover;
}
```

## Reference the Custom CSS File

```php
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
```
