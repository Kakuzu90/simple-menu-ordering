<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuList;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index() {
        return response()->json(MenuCategory::all());
    }

    public function default() {
        $first = MenuCategory::pluck('id')->first();
        return response()->json(MenuList::where('category_id', $first)->with('category')->get());
    }

    public function show($id) {
        return response()->json(MenuList::where('category_id', $id)->get());
    }
}
