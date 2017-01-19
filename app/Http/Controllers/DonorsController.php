<?php

namespace App\Http\Controllers;

use App\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreDonorsRequest;
use App\Http\Requests\UpdateDonorsRequest;
use Yajra\Datatables\Datatables;

class DonorsController extends Controller
{
    /**
     * Display a listing of Donor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('donor_access')) {
            return abort(401);
        }
        
        if (request()->ajax()) {
            $query = Donor::query();
            $query->with("category");
            $table = Datatables::of($query);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $gateKey  = 'donor_';
                $routeKey = 'donors';

                return view('actionsTemplate', compact('row', 'gateKey', 'routeKey'));
            });

            return $table->make(true);
        }

        return view('donors.index');
    }

    /**
     * Show the form for creating new Donor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('donor_create')) {
            return abort(401);
        }
        $relations = [
            'categories' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        return view('donors.create', $relations);
    }

    /**
     * Store a newly created Donor in storage.
     *
     * @param  \App\Http\Requests\StoreDonorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonorsRequest $request)
    {
        if (! Gate::allows('donor_create')) {
            return abort(401);
        }
        $donor = Donor::create($request->all());

        return redirect()->route('donors.index');
    }


    /**
     * Show the form for editing Donor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('donor_edit')) {
            return abort(401);
        }
        $relations = [
            'categories' => \App\Category::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $donor = Donor::findOrFail($id);

        return view('donors.edit', compact('donor') + $relations);
    }

    /**
     * Update Donor in storage.
     *
     * @param  \App\Http\Requests\UpdateDonorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonorsRequest $request, $id)
    {
        if (! Gate::allows('donor_edit')) {
            return abort(401);
        }
        $donor = Donor::findOrFail($id);
        $donor->update($request->all());

        return redirect()->route('donors.index');
    }


    /**
     * Remove Donor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('donor_delete')) {
            return abort(401);
        }
        $donor = Donor::findOrFail($id);
        $donor->delete();

        return redirect()->route('donors.index');
    }

    /**
     * Delete all selected Donor at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('donor_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Donor::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
