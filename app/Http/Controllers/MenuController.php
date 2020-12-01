<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menu;
    protected $menuRecusive;
    public function __construct(
        Menu $menu,
        MenuRecusive $menuRecusive
    ) {
        $this->menu = $menu;
        $this->menuRecusive = $menuRecusive;
    }
    public function index()
    {
        $data = $this->menu->latest()->paginate(10);
        return view('menu.list', compact('data'));
    }

    public function create()
    {
        $htmlSelect = $this->menuRecusive ->menuRecusiveAdd();
        return view('menu.add', compact('htmlSelect'));
    }

    public function store(Request $request)
    {
        try {
            $this->menu->create([
                'name'=> $request->menu_name,
                'parent_id'=> $request->menu_parent,
            ]);
            $message = 'Create Menu Success.';
        } catch (\Exception $e) {
            $message = 'Error: '.$e->getMessage();
        }

        return redirect()->route('menus.index')->with('message', $message);
    }

    public function delete($id)
    {
        $message = '';
        if($id) {
            try {
                $category = $this->menu->find($id);
                $category->delete();
                $message = 'Delete Menu success.';
            } catch (\Exception $e) {
                $message = 'Error: '.$e->getMessage();
            }

        }
        return redirect()->route('menus.index')->with('message', $message);
    }

    public function edit($id)
    {

       dd('edit menu');
    }

    public function update($id, Request $request)
    {
        try {
            dd('update menu');
//            $this->category->find($id)->update([
//                'name'=> $request->category_name,
//                'parent_id'=> $request->category_parent,
//            ]);
            $message = 'Update Category success.';
        } catch (\Exception $e) {
            $message = 'Error: '.$e->getMessage();
        }
        return redirect()->route('categories.index')->with('message', $message);
    }
}
