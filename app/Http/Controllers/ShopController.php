<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $category;

    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }

    public function index($slug, $id)
    {
        $currentCategory = $this->category->find($id);
        $categories = $this->category->where('parent_id', 0)->get();
        $categoriesLimit = $this->category->where('parent_id', 0)->take(3)->get();
        if($currentCategory) {
            $listingProduct = $currentCategory->productChildren()->paginate(3);
            return view('product_listing.listing', compact('listingProduct', 'currentCategory', 'categories', 'categoriesLimit'));
        }
        return abort('403');
    }
}
