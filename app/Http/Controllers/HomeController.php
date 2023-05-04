<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
  public function index() {
    $viewData = [
			'title' => 'Home Page - Online Store'
		];

    return view('home.index')->with("viewData", $viewData);
  }

  /**
   * Name of the data that will be passed to the view
   * The names are doesn't make sense, but it's just for the example
   * It's better to use names that make sense
   * Pass viewData instead, like the above example
   */
  public function about() {
    /* $data1 = "About us - Online Store";
    $data2 = "About us";
    $description = "This is an about page ...";
    $author = "Developed by: Your Name";
    return view('home.about')->with("title", $data1)
    ->with("subtitle", $data2)
    ->with("description", $description)
    ->with("author", $author); */

    $viewData = [
			'title' => 'About us - Online Store',
			'subtitle' => 'About us',
			'description' => 'This is an about page ...',
			'author' => 'Developed by: Your Name'
		];

    return view('home.about')->with("viewData", $viewData);
  }
}