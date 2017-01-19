<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreSizesRequest;
use App\Http\Requests\UpdateSizesRequest;
use Yajra\Datatables\Datatables;

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
        
        if (request()->ajax()) {
            $query = Size::query();
            $table = Datatables::of($query);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $gateKey  = 'size_';
                $routeKey = 'sizes';

                return view('actionsTemplate', compact('row', 'gateKey', 'routeKey'));
            });

            return $table->make(true);
        }

        return view('sizes.index');
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
        return view('sizes.create');
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
        $size = Size::findOrFail($id);

        return view('sizes.edit', compact('size'));
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
