<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminHomeController extends Controller {
  public function index() {
    $viewData = [
			'title' => 'Admin Page - Admin - Online Store'
		];

    return view('admin.home.index')->with("viewData", $viewData);
  }
}