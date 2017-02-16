<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use App\TopMenuItem;
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
        $menuItems = TopMenuItem::where('is_main', 1)->get();
        $where = [];

        if ($request->get('cat')) {
            $category = Category::findOrFail((int)$request->get('cat'));
            $where[] =['category_id','=',(int)$request->get('cat')];
        }

        if ($request->get('search')) {
            $where[] = ['name', 'like', $request->get('search').'%'];
        }

        $products = Product::where($where)->paginate(16);
        $sliders = Slider::where('is_active', '1')->get();
        return view('front.index', [
            'products' => $products,
            'sliders' => $sliders,
            'menuItems' => $menuItems
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
        $menuItems = TopMenuItem::where('is_main', 1)->get();
        $where = [];
        $products = Product::where($where)->latest('created_at')->limit(4)->get();
        $productId = Product::find($id);

        return view('front.show', [
            'product' => $productId,
            'products' => $products,
            'menuItems' => $menuItems
        ]);
    }
}
