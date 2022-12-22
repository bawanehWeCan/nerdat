<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\{StoreUnitRequest, UpdateUnitRequest};
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:unit view')->only('index', 'show');
        $this->middleware('permission:unit create')->only('create', 'store');
        $this->middleware('permission:unit edit')->only('edit', 'update');
        $this->middleware('permission:unit delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $units = Unit::with('subject:id,name', );

            return DataTables::of($units)
                ->addColumn('name', function($row){
                    return str($row->name)->limit(100);
                })
				->addColumn('description', function($row){
                    return str($row->description)->limit(100);
                })
				->addColumn('subject', function ($row) {
                    return $row->subject ? $row->subject->name : '';
                })->addColumn('action', 'units.include.action')
                ->toJson();
        }

        return view('units.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {

        Unit::create($request->validated());

        return redirect()
            ->route('units.index')
            ->with('success', __('The unit was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        $unit->load('subject:id,name', );

		return view('units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $unit->load('subject:id,name', );

		return view('units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {

        $unit->update($request->validated());

        return redirect()
            ->route('units.index')
            ->with('success', __('The unit was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();

            return redirect()
                ->route('units.index')
                ->with('success', __('The unit was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('units.index')
                ->with('error', __("The unit can't be deleted because it's related to another table."));
        }
    }
}
