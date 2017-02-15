<?php

namespace App\Http\Controllers;

use App\TopMenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTopMenuItemsRequest;
use App\Http\Requests\UpdateTopMenuItemsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\Datatables\Datatables;

class TopMenuItemsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of TopMenuItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $top_menu_items = TopMenuItem::all();

        return view('top_menu_items.index', compact('top_menu_items'));
    }

    /**
     * Show the form for creating new TopMenuItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'subitems' => \App\TopMenuItem::where('is_main', 0)->get()->pluck('name', 'id'),
        ];

        return view('top_menu_items.create', $relations);
    }

    /**
     * Store a newly created TopMenuItem in storage.
     *
     * @param  \App\Http\Requests\StoreTopMenuItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopMenuItemsRequest $request)
    {

        $request = $this->saveFiles($request);
        $top_menu_item = TopMenuItem::create($request->all());
        $top_menu_item->subitems()->sync(array_filter((array)$request->input('subitems')));

        return redirect()->route('top_menu_items.index');
    }


    /**
     * Show the form for editing TopMenuItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $relations = [
            'subitems' => \App\TopMenuItem::where('is_main', 0)->get()->pluck('name', 'id'),
        ];

        $top_menu_item = TopMenuItem::findOrFail($id);

        return view('top_menu_items.edit', compact('top_menu_item') + $relations);
    }

    /**
     * Update TopMenuItem in storage.
     *
     * @param  \App\Http\Requests\UpdateTopMenuItemsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopMenuItemsRequest $request, $id)
    {

        $request = $this->saveFiles($request);
        $top_menu_item = TopMenuItem::findOrFail($id);
        $top_menu_item->update($request->all());
        $top_menu_item->subitems()->sync(array_filter((array)$request->input('subitems')));

        return redirect()->route('top_menu_items.index');
    }


    /**
     * Display TopMenuItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'subitems' => \App\TopMenuItem::get()->pluck('name', 'id'),
        ];

        $top_menu_item = TopMenuItem::findOrFail($id);

        return view('top_menu_items.show', compact('top_menu_item') + $relations);
    }


    /**
     * Remove TopMenuItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $top_menu_item = TopMenuItem::findOrFail($id);
        $top_menu_item->delete();

        return redirect()->route('top_menu_items.index');
    }

    /**
     * Delete all selected TopMenuItem at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = TopMenuItem::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
