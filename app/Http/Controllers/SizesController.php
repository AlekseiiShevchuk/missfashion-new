<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreSizesRequest;
use App\Http\Requests\UpdateSizesRequest;

class SizesController extends Controller
{
    /**
     * Display a listing of Size.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('size_access')) {
            return abort(401);
        }
        $sizes = Size::all();

        return view('sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating new Size.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('size_create')) {
            return abort(401);
        }
        $relations = [
            'products' => \App\Product::get()->pluck('name', 'id'),
        ];

        return view('sizes.create', $relations);
    }

    /**
     * Store a newly created Size in storage.
     *
     * @param  \App\Http\Requests\StoreSizesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSizesRequest $request)
    {
        if (! Gate::allows('size_create')) {
            return abort(401);
        }
        $size = Size::create($request->all());

        return redirect()->route('sizes.index');
    }


    /**
     * Show the form for editing Size.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('size_edit')) {
            return abort(401);
        }
        $relations = [
            'products' => \App\Product::get()->pluck('name', 'id'),
        ];

        $size = Size::findOrFail($id);

        return view('sizes.edit', compact('size') + $relations);
    }

    /**
     * Update Size in storage.
     *
     * @param  \App\Http\Requests\UpdateSizesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSizesRequest $request, $id)
    {
        if (! Gate::allows('size_edit')) {
            return abort(401);
        }
        $size = Size::findOrFail($id);
        $size->update($request->all());

        return redirect()->route('sizes.index');
    }


    /**
     * Display Size.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('size_view')) {
            return abort(401);
        }
        $relations = [
            'products' => \App\Product::get()->pluck('name', 'id'),
        ];

        $size = Size::findOrFail($id);

        return view('sizes.show', compact('size') + $relations);
    }


    /**
     * Remove Size from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('size_delete')) {
            return abort(401);
        }
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect()->route('sizes.index');
    }

    /**
     * Delete all selected Size at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('size_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Size::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
