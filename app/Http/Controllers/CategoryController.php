<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
class CategoryController extends Controller
{
    const ROUTE = 'category';
    protected $category;
    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }

    public function index()
    {
        $route =  self::ROUTE;
        $data = $this->category->latest()->paginate(5);
        return view('category.list', compact('route', 'data'));
    }

    public function create()
    {
        $htmlSelect = $this->handleCategorySelect();
        return view('category.add',compact('htmlSelect'));
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
        return view('category.edit',compact('category', 'htmlSelect'));
    }

    public function update($id, Request $request)
    {
        try {
            $this->category->find($id)->update([
                'name'=> $request->category_name,
                'parent_id'=> $request->category_parent,
            ]);
            $message = 'Update Category success.';
        } catch (\Exception $e) {
            $message = 'Error: '.$e->getMessage();
        }
        return redirect()->route('categories.index')->with('message', $message);
    }
}
