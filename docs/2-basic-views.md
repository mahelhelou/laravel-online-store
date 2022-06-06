# Create Basic Views

## Index View

- Create a subfolder in the `resources/views` named `home`, inside this folder, create a file named `index.blade.php`:

```php
@extends('layouts.app')
@section('title', $viewData["title"])
@section('content')
<div class="row">
  <div class="col-md-6 col-lg-4 mb-2">
    <img src="{{ asset('/images/game.png') }}" class="img-fluid rounded">
  </div>
  <div class="col-md-6 col-lg-4 mb-2">
    <img src="{{ asset('/images/safe.png') }}" class="img-fluid rounded">
  </div>
  <div class="col-md-6 col-lg-4 mb-2">
    <img src="{{ asset('/images/submarine.png') }}" class="img-fluid rounded">
  </div>
</div>
@endsection
```

The first `@section` injects the content of the `viewData["title"]` variable. That variable will be defined in the `web` route file and passed to this view.

## About View

- Inside this folder, create a file named `about.blade.php`:

```php
@extends('layouts.app')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-4 ms-auto">
      <p class="lead">{{ $description }}</p>
    </div>
    <div class="col-lg-4 me-auto">
      <p class="lead">{{ $author }}</p>
    </div>
  </div>
</div>
@endsection
```

## Refactoring Views

- `home.index` view uses the recommended method of viewing the data, so we'll refactor only `home.about` view.

See [HomeController](4-controllers.md).

```php
@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-4 ms-auto">
      <p class="lead">{{ $viewData['description'] }}</p>
    </div>
    <div class="col-lg-4 me-auto">
      <p class="lead">{{ $viewData['author'] }}</p>
    </div>
  </div>
</div>
@endsection
```
