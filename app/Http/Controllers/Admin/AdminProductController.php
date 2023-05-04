<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller {
  public function index() {
    $viewData = [
			'title' => 'Admin Page - Products - Online Store',
			'products' => Product::all()
		];

    return view('admin.product.index')->with("viewData", $viewData);
  }

  /**
	 * Create a new product
	 * store() receives a $request object,which deals with http requests handled by the application
	 * If the validation() rules pass, the request continues to execute
	 * An exception will be thrown if validation fails, and the global $errors variable, provided by Laravel, will be shown in /views/admin/products
	 */
  public function store(Request $request) {
    // Refactor: Move the validation into `Model` or separate class to avoid duplication
		/* $request->validate([
      'name'        => 'required|max:255',
      'description' => 'required',
      'price'       => 'required|numeric|gt:0',
      'image'       => 'image'
    ]); */

		/**
		 * After the request is successfully submitted:
		 * Add a new product -> Create a new resource using Proudct Model
		 * Set the resource attributes
		 * The attributes are collected by the submitted form
		 * The request->input() method is used to retrieve the form inputs
		 */
    $newProduct = new Product();

    $newProduct->setName($request->input('name'));
    $newProduct->setDescription($request->input('description'));
    $newProduct->setPrice($request->input('price'));
    $newProduct->setImage("game.png");
    $newProduct->save();

		/// Run php artisan storage:link to start showing public uploaded images to users
		if ($request->hasFile('image')) {
			$imageName = $newProduct->getId() . '.' .$request->file('image')->extension();
			Storage::disk('public')->put(
					$imageName,
					file_get_contents($request->file('image')->getRealPath())
			);

			$newProduct->setImage($imageName);
			$newProduct->save();
		}

    return back();
  }

	// Edit product
	public function edit($id) {
		$viewData = [
			'title' => 'Admin Page - Edit Product - Online Store',
			'product' => Product::findOrFail($id)
		];

		return view('admin.product.edit')->with('viewData', $viewData);
	}

	// Update the product to DB
	public function update(Request $request, $id) {
		// Refactor: Move the validation into `Model` or separate class to avoid duplication
		/* $request->validate([
			'name' => ['required', 'max:15'],
			'price' => ['required', 'numeric'],
			'description' => ['required', 'max:255'],
			'image'	=> 'image'
		]); */

		$product = Product::findOrFail($id);

		$product->setName($request->input('name'));
		$product->setPrice($request->input('price'));
		$product->setDescription($request->input('description'));

		if ($request->hasFile('image')) {
			$imageName = $product->getId() . '.' . $request->file('image')->extension();
			Storage::disk('public')->put(
				$imageName,
				file_get_contents($request->file('image')->getRealPath())
			);

			$product->setImage($imageName);
		}

		$product->save();
		return redirect()->route('admin.product.index');
	}

	// Delete product
	public function delete($id) {
		Product::destroy($id);
		return back();
	}
}