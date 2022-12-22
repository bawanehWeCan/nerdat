<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Http\Requests\{StoreTipRequest, UpdateTipRequest};
use Yajra\DataTables\Facades\DataTables;

class TipController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tip view')->only('index', 'show');
        $this->middleware('permission:tip create')->only('create', 'store');
        $this->middleware('permission:tip edit')->only('edit', 'update');
        $this->middleware('permission:tip delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $tips = Tip::query();

            return DataTables::of($tips)
                ->addColumn('note', function($row){
                    return str($row->note)->limit(100);
                })
				->addColumn('action', 'tips.include.action')
                ->toJson();
        }

        return view('tips.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipRequest $request)
    {
        
        Tip::create($request->validated());

        return redirect()
            ->route('tips.index')
            ->with('success', __('The tip was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function show(Tip $tip)
    {
        return view('tips.show', compact('tip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function edit(Tip $tip)
    {
        return view('tips.edit', compact('tip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipRequest $request, Tip $tip)
    {
        
        $tip->update($request->validated());

        return redirect()
            ->route('tips.index')
            ->with('success', __('The tip was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip)
    {
        try {
            $tip->delete();

            return redirect()
                ->route('tips.index')
                ->with('success', __('The tip was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('tips.index')
                ->with('error', __("The tip can't be deleted because it's related to another table."));
        }
    }
}
