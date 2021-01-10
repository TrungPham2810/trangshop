<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $slider;
    protected $category;
    protected $product;

    public function __construct(
        Slider $slider,
        Category $category,
        Product $product
    ) {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
    }

    public function index()
    {
        $sliders = $this->slider->all();
        $categories = $this->category->where('parent_id', 0)->get();
        $categoriesLimit = $this->category->where('parent_id', 0)->take(3)->get();
        $categoriesTab = $this->category->whereIn('id', [1,2,3])->get();
        $products = $this->product->limit(6)->get();
        $productsRecommend = $this->product->latest('view','desc')->take(12)->get()->toArray();
        $productsRecommend = array_chunk($productsRecommend, 3);
        return view('home.home', compact('sliders', 'categories', 'products', 'productsRecommend', 'categoriesTab', 'categoriesLimit'));
    }

    public function test()
    {
        return view('test');
    }
}
