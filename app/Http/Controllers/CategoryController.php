<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const ROUTE = 'category';
    public function index()
    {
        $route =  self::ROUTE;
        return view('category.list', compact('route'));
    }

    public function create()
    {
        return view('category.add');
    }

    public function save(Request $request)
    {

    }
}
