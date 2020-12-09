<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.menu.list', compact('data'));
    }

    public function create()
    {
        $htmlSelect = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menu.add', compact('htmlSelect'));
    }

    public function store(Request $request)
    {
        try {
            $this->menu->create([
                'name'=> $request->menu_name,
                'parent_id'=> $request->menu_parent,
                'slug'=> Str::slug($request->menu_name),
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
                $menu = $this->menu->find($id);
                if($menu) {
                    $menu->delete();
                    $message = 'Delete Menu success.';
                } else {
                    $message = 'Can\'t found menu with id '. $id;
                }
            } catch (\Exception $e) {
                $message = 'Error: '.$e->getMessage();
            }

        }
        return redirect()->route('menus.index')->with('message', $message);
    }

    public function edit($id)
    {

        $menu = $this->menu->find($id);
        $htmlSelect = $this->menuRecusive->menuRecusiveAdd(0, $menu->parent_id);
        return view('admin.menu.edit',compact('menu', 'htmlSelect'));
    }

    public function update($id, Request $request)
    {
        try {

            $this->menu->find($id)->update([
                'name'=> $request->menu_name,
                'parent_id'=> $request->menu_parent,
            ]);
            $message = 'Update Menu success.';
        } catch (\Exception $e) {
            $message = 'Error: '.$e->getMessage();
        }
        return redirect()->route('menus.index')->with('message', $message);
    }
}
