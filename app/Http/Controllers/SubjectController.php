<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\{StoreSubjectRequest, UpdateSubjectRequest};
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:subject view')->only('index', 'show');
        $this->middleware('permission:subject create')->only('create', 'store');
        $this->middleware('permission:subject edit')->only('edit', 'update');
        $this->middleware('permission:subject delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $subjects = Subject::with('classroom:id,name', );

            return DataTables::of($subjects)
                ->addColumn('name', function($row){
                    return str($row->name)->limit(100);
                })
				->addColumn('description', function($row){
                    return str($row->description)->limit(100);
                })
				->addColumn('classroom', function ($row) {
                    return $row->classroom ? $row->classroom->name : '';
                })->addColumn('action', 'subjects.include.action')
                ->toJson();
        }

        return view('subjects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        
        Subject::create($request->validated());

        return redirect()
            ->route('subjects.index')
            ->with('success', __('The subject was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject->load('classroom:id,name', );

		return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $subject->load('classroom:id,name', );

		return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        
        $subject->update($request->validated());

        return redirect()
            ->route('subjects.index')
            ->with('success', __('The subject was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();

            return redirect()
                ->route('subjects.index')
                ->with('success', __('The subject was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('subjects.index')
                ->with('error', __("The subject can't be deleted because it's related to another table."));
        }
    }
}
