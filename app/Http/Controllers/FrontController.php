<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all()->take(7)->pluck('name', 'id');
        $where = [];

        if ($request->get('cat')) {
            $category = Category::findOrFail((int)$request->get('cat'));
            $where[] =['category_id','=',(int)$request->get('cat')];
        }

        if ($request->get('search')) {
            $where[] = ['name', 'like', $request->get('search').'%'];
        }

        $products = Product::where($where)->paginate(16);
        return view('front.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
