@extends('layouts.app')

@section('title', $viewData["title"])

@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="row">
  @foreach ($viewData["products"] as $product)
  <div class="col-md-4 col-lg-3 mb-2">
    <div class="card">
			{{-- Getting the product image from directly from the attribute --}}
      {{-- <img src="{{ asset('/images/' . $product['image']) }}" class="card-img-top img-card"> --}}

			<!-- Getting the product image from getters methods -->
      {{-- <img src="{{ asset('/images/' . $product->getImage()) }}" class="card-img-top img-card"> --}}
      <img src="{{ asset('/storage/' . $product->getImage()) }}" class="card-img-top img-card">
      <div class="card-body text-center">
				{{-- Getting the product name directly from the attribute --}}
        {{-- <a href="{{ route('product.show', ['id' => $product['id']]) }}" class="btn bg-primary text-white">{{ $product['name'] }}</a> --}}

				{{-- Getting the product name from getters methods --}}
        <a href="{{ route('product.show', ['id' => $product['id']]) }}" class="btn bg-primary text-white">{{ $product->getName() }}</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection