<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreSlidersRequest;
use App\Http\Requests\UpdateSlidersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\Datatables\Datatables;

class SlidersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Slider.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('slider_access')) {
            return abort(401);
        }
        $sliders = Slider::all();

        return view('sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating new Slider.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('slider_create')) {
            return abort(401);
        }
        return view('sliders.create');
    }

    /**
     * Store a newly created Slider in storage.
     *
     * @param  \App\Http\Requests\StoreSlidersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlidersRequest $request)
    {
        if (! Gate::allows('slider_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $slider = Slider::create($request->all());

        return redirect()->route('sliders.index');
    }


    /**
     * Show the form for editing Slider.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('slider_edit')) {
            return abort(401);
        }
        $slider = Slider::findOrFail($id);

        return view('sliders.edit', compact('slider'));
    }

    /**
     * Update Slider in storage.
     *
     * @param  \App\Http\Requests\UpdateSlidersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlidersRequest $request, $id)
    {
        if (! Gate::allows('slider_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $slider = Slider::findOrFail($id);
        $slider->update($request->all());

        return redirect()->route('sliders.index');
    }


    /**
     * Display Slider.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('slider_view')) {
            return abort(401);
        }
        $slider = Slider::findOrFail($id);

        return view('sliders.show', compact('slider'));
    }


    /**
     * Remove Slider from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('slider_delete')) {
            return abort(401);
        }
        $slider = Slider::findOrFail($id);
        $slider->delete();

        return redirect()->route('sliders.index');
    }

    /**
     * Delete all selected Slider at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('slider_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Slider::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
