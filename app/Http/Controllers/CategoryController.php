<?php

namespace App\Http\Controllers;

use App\Category;
use App\Shop;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    const ROUTE = 'category';
    protected $category;
    protected $shop;
    protected $test;
    public function __construct(
        Category $category,
        Shop $shop,
        Test $test
    ) {
        $this->category = $category;
        $this->test = $test;
        $this->shop = $shop;
    }

    public function index()
    {
        $shop = $this->shop->find(1);
        $listTest = $shop->test;
        $test = $this->test->find(1);
        $listShop = $test->shops;

        $route =  self::ROUTE;
        $data = $this->category->latest()->paginate(10);
        return view('admin.category.list', compact('route', 'data'));
    }

    public function create()
    {
        $htmlSelect = $this->handleCategorySelect();
        return view('admin.category.add',compact('htmlSelect'));
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
        $message = '';
        try {
            $this->category->create([
                'name'=> $request->category_name,
                'parent_id'=> $request->category_parent,
                'slug' => str_replace(" ","_",strtolower($request->category_name))
            ]);
            $message = 'Create Category success.';
        } catch (\Exception $e) {
            $message = 'Error: '.$e->getMessage();
        }

        return redirect()->route('categories.index')->with('message', $message);
    }

    public function delete($id)
    {
        $message = '';
        if($id) {
            try {
                $category = $this->category->find($id);
                $category->delete();
                $message = 'Delete Category success.';
            } catch (\Exception $e) {
                $message = 'Error: '.$e->getMessage();
            }

        }
        return redirect()->route('categories.index')->with('message', $message);
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlSelect = $this->handleCategorySelect(0, $category->parent_id);
        return view('admin.category.edit',compact('category', 'htmlSelect'));
    }

    public function update($id, Request $request)
    {
        try {
            $this->category->find($id)->update([
                'name'=> $request->category_name,
                'parent_id'=> $request->category_parent,
                'slug' => str_replace(" ","_",strtolower($request->category_name))
            ]);
            $message = 'Update Category success.';
        } catch (\Exception $e) {
            $message = 'Error: '.$e->getMessage();
        }
        return redirect()->route('categories.index')->with('message', $message);
    }
}
