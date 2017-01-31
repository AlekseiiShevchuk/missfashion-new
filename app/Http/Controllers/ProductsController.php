<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use Yajra\Datatables\Datatables;

class ProductsController extends Controller
{
    /**
     * Display a listing of Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_access')) {
            return abort(401);
        }
        
        if (request()->ajax()) {
            $query = Product::query();
            $query->with("category");
            $query->with("images");
            $query->with("colors");
            $query->with("sizes");
            $table = Datatables::of($query);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $gateKey  = 'product_';
                $routeKey = 'products';

                return view('actionsTemplate', compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('images.url', function ($row) {
                return '<span class="label label-info label-many">' . implode('</span><br><span class="label label-info label-many">',
                        $row->images->pluck('url')->toArray()) . '</span>';
            });
            $table->editColumn('colors.name', function ($row) {
                return '<span class="label label-info label-many">' . implode('</span><br><span class="label label-info label-many">',
                        $row->colors->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('sizes.name', function ($row) {
                return '<span class="label label-info label-many">' . implode('</span><br><span class="label label-info label-many">',
                        $row->sizes->pluck('name')->toArray()) . '</span>';
            });

            return $table->make(true);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating new Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        $relations = [
            'categories' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
            'images' => \App\Image::get()->pluck('url', 'id'),
            'colors' => \App\Color::get()->pluck('name', 'id'),
            'sizes' => \App\Size::get()->pluck('name', 'id'),
        ];

        return view('products.create', $relations);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param  \App\Http\Requests\StoreProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        $product = Product::create($request->all());
        $product->images()->sync(array_filter((array)$request->input('images')));
        $product->colors()->sync(array_filter((array)$request->input('colors')));
        $product->sizes()->sync(array_filter((array)$request->input('sizes')));

        return redirect()->route('products.index');
    }


    /**
     * Show the form for editing Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        $relations = [
            'categories' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
            'images' => \App\Image::get()->pluck('url', 'id'),
            'colors' => \App\Color::get()->pluck('name', 'id'),
            'sizes' => \App\Size::get()->pluck('name', 'id'),
        ];

        $product = Product::findOrFail($id);

        return view('products.edit', compact('product') + $relations);
    }

    /**
     * Update Product in storage.
     *
     * @param  \App\Http\Requests\UpdateProductsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, $id)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        $product = Product::findOrFail($id);
        $product->update($request->all());
        $product->images()->sync(array_filter((array)$request->input('images')));
        $product->colors()->sync(array_filter((array)$request->input('colors')));
        $product->sizes()->sync(array_filter((array)$request->input('sizes')));

        return redirect()->route('products.index');
    }


    /**
     * Display Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('product_view')) {
            return abort(401);
        }
        $relations = [
            'categories' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
            'images' => \App\Image::get()->pluck('url', 'id'),
            'colors' => \App\Color::get()->pluck('name', 'id'),
            'sizes' => \App\Size::get()->pluck('name', 'id'),
        ];

        $product = Product::findOrFail($id);

        return view('products.show', compact('product') + $relations);
    }


    /**
     * Remove Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }

    /**
     * Delete all selected Product at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Product::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}