<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreColorsRequest;
use App\Http\Requests\UpdateColorsRequest;

class ColorsController extends Controller
{
    /**
     * Display a listing of Color.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('color_access')) {
            return abort(401);
        }
        $colors = Color::all();

        return view('colors.index', compact('colors'));
    }

    /**
     * Show the form for creating new Color.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('color_create')) {
            return abort(401);
        }
        $relations = [
            'products' => \App\Product::get()->pluck('name', 'id'),
        ];

        return view('colors.create', $relations);
    }

    /**
     * Store a newly created Color in storage.
     *
     * @param  \App\Http\Requests\StoreColorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColorsRequest $request)
    {
        if (! Gate::allows('color_create')) {
            return abort(401);
        }
        $color = Color::create($request->all());

        return redirect()->route('colors.index');
    }


    /**
     * Show the form for editing Color.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('color_edit')) {
            return abort(401);
        }
        $relations = [
            'products' => \App\Product::get()->pluck('name', 'id'),
        ];

        $color = Color::findOrFail($id);

        return view('colors.edit', compact('color') + $relations);
    }

    /**
     * Update Color in storage.
     *
     * @param  \App\Http\Requests\UpdateColorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColorsRequest $request, $id)
    {
        if (! Gate::allows('color_edit')) {
            return abort(401);
        }
        $color = Color::findOrFail($id);
        $color->update($request->all());

        return redirect()->route('colors.index');
    }


    /**
     * Display Color.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('color_view')) {
            return abort(401);
        }
        $relations = [
            'products' => \App\Product::get()->pluck('name', 'id'),
        ];

        $color = Color::findOrFail($id);

        return view('colors.show', compact('color') + $relations);
    }


    /**
     * Remove Color from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('color_delete')) {
            return abort(401);
        }
        $color = Color::findOrFail($id);
        $color->delete();

        return redirect()->route('colors.index');
    }

    /**
     * Delete all selected Color at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('color_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Color::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
