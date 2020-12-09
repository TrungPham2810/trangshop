<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Components\Recusive;

class AdminProductController extends Controller
{

    protected $category;
    protected $product;
    public function __construct(
        Category $category,
        Product $product
    ) {
        $this->category = $category;
        $this->product = $product;
    }
    public function index()
    {
        $data = $this->product->latest()->paginate(10);
        return view('admin.product.list', compact('data'));
    }

    public function create()
    {
        $htmlSelect = $this->handleCategorySelect();
        return view('admin.product.add',compact('htmlSelect'));
    }
    public function handleCategorySelect($id = 0, $currentCategory = 0)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlSelect = $recusive->categoryRecusive($id, $currentCategory);
        return $htmlSelect;
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function update($id, Request $request )
    {

    }

    public function delete($id)
    {

    }
}
