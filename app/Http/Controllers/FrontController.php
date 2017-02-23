<?php

namespace App\Http\Controllers;

use App\Category;
use App\CustomOption;
use App\Product;
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
        $products = Product::query();
        $customBlock = CustomOption::find('main_page_content_block')->value;
        $menuItems = TopMenuItem::where('is_main', 1)->get();

        if ($request->get('search')) {
            $products = $products->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->get('sort') == 'priceHF') {
            $products = $products->orderBy('old_price', 'desc');
        }

        if ($request->get('sort') == 'priceLF') {
            $products = $products->orderBy('old_price', 'asc');
        }

        if ($request->get('sort') == 'nameAZ') {
            $products = $products->orderBy('name', 'asc');
        }

        if ($request->get('sort') == 'nameZA') {
            $products = $products->orderBy('name', 'desc');
        }
        $categoryName = 'All Products';
        $products = $products->paginate(16);

        return view('front.index', [
            'products' => $products,
            'menuItems' => $menuItems,
            'customBlock' => $customBlock,
            'categoryName' => $categoryName,
        ]);
    }

    public function categoryIndex(Category $category, Request $request)
    {
        $menuItems = TopMenuItem::where('is_main', 1)->get();

        $catId = $category->id;
        $customBlock = $category->content_block;
        $categoryName = $category->name;

        $products = Product::query();
        $products = $products->where('category_id', $catId);

        if ($request->get('search')) {
            $products = $products->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->get('sort') == 'priceHF') {
            $products = $products->orderBy('old_price', 'desc');
        }

        if ($request->get('sort') == 'priceLF') {
            $products = $products->orderBy('old_price', 'asc');
        }

        if ($request->get('sort') == 'nameAZ') {
            $products = $products->orderBy('name', 'asc');
        }

        if ($request->get('sort') == 'nameZA') {
            $products = $products->orderBy('name', 'desc');
        }


        $products = $products->paginate(16);
        return view('front.index', [
            'products' => $products,
            'menuItems' => $menuItems,
            'customBlock' => $customBlock,
            'catId' => $catId,
            'categoryName' => $categoryName,
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
