<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Http\Requests\{StoreResultRequest, UpdateResultRequest};
use Yajra\DataTables\Facades\DataTables;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:result view')->only('index', 'show');
        $this->middleware('permission:result create')->only('create', 'store');
        $this->middleware('permission:result edit')->only('edit', 'update');
        $this->middleware('permission:result delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $results = Result::with('user:id,name');

            return DataTables::of($results)
                ->addColumn('name', function($row){
                    return str($row->name)->limit(100);
                })
				->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '';
                })->addColumn('action', 'results.include.action')
                ->toJson();
        }

        return view('results.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('results.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResultRequest $request)
    {
        
        Result::create($request->validated());

        return redirect()
            ->route('results.index')
            ->with('success', __('The result was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        $result->load('user:id,name');

		return view('results.show', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        $result->load('user:id,name');

		return view('results.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResultRequest $request, Result $result)
    {
        
        $result->update($request->validated());

        return redirect()
            ->route('results.index')
            ->with('success', __('The result was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        try {
            $result->delete();

            return redirect()
                ->route('results.index')
                ->with('success', __('The result was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('results.index')
                ->with('error', __("The result can't be deleted because it's related to another table."));
        }
    }
}
