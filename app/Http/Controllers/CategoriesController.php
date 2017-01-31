<?php

namespace App\Http\Controllers;

use App\Category;
use App\Donor;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\Datatables\Datatables;

class CategoriesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('category_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Category::query();
            $query->with("parent");
            $query->with("donors");
            $table = Datatables::of($query);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $gateKey = 'category_';
                $routeKey = 'categories';

                return view('actionsTemplate', compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('photo', function ($row) {
                if ($row->photo) {
                    return '<a href="' . asset('uploads/' . $row->photo) . '" target="_blank"><img src="' . asset('uploads/thumb/' . $row->photo) . '"/>';
                };
            });
            $table->editColumn('donors.url', function ($row) {
                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->donors->pluck('url')->toArray()) . '</span>';
            });

            return $table->make(true);
        }

        return view('categories.index');
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('category_create')) {
            return abort(401);
        }
        $relations = [
            'parents' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
            'donors' => \App\Donor::get()->pluck('url', 'id'),
        ];

        return view('categories.create', $relations);
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        if (!Gate::allows('category_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $category = Category::create($request->all());
        $category->donors()->saveMany(Donor::find(array_filter((array)$request->input('donors'))));

        return redirect()->route('categories.index');
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('category_edit')) {
            return abort(401);
        }
        $relations = [
            'parents' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
            'donors' => \App\Donor::get()->pluck('url', 'id'),
        ];

        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category') + $relations);
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        if (!Gate::allows('category_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        foreach ($category->donors as $donor) {
            $donor->category()->dissociate();
            $donor->save();
        }
        $category->donors()->saveMany(Donor::find(array_filter((array)$request->input('donors'))));

        return redirect()->route('categories.index');
    }


    /**
     * Display Category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('category_view')) {
            return abort(401);
        }
        $relations = [
            'parents' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
            'donors' => \App\Donor::get()->pluck('url', 'id'),
        ];

        $category = Category::findOrFail($id);

        return view('categories.show', compact('category') + $relations);
    }


    /**
     * Remove Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index');
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
