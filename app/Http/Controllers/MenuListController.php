<?php

namespace App\Http\Controllers;

use App\Models\MenuList;
use Illuminate\Http\Request;

class MenuListController extends Controller
{
    public function show($id) {
        return response()->json(MenuList::where('id', $id)->with('category')->get());
    }

    public function totalRaw($id) {
        $tax = MenuList::where('id', $id)->sum('tax');
        $price = MenuList::where('id', $id)->sum('price');
        $total = ($tax + $price);
        return $total;
    }
}
