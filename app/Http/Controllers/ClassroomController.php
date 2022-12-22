<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\{StoreClassroomRequest, UpdateClassroomRequest};
use Yajra\DataTables\Facades\DataTables;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:classroom view')->only('index', 'show');
        $this->middleware('permission:classroom create')->only('create', 'store');
        $this->middleware('permission:classroom edit')->only('edit', 'update');
        $this->middleware('permission:classroom delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $classrooms = Classroom::query();

            return DataTables::of($classrooms)
                ->addColumn('name', function($row){
                    return str($row->name)->limit(100);
                })
				->addColumn('action', 'classrooms.include.action')
                ->toJson();
        }

        return view('classrooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        
        Classroom::create($request->validated());

        return redirect()
            ->route('classrooms.index')
            ->with('success', __('The classroom was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return view('classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        
        $classroom->update($request->validated());

        return redirect()
            ->route('classrooms.index')
            ->with('success', __('The classroom was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        try {
            $classroom->delete();

            return redirect()
                ->route('classrooms.index')
                ->with('success', __('The classroom was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('classrooms.index')
                ->with('error', __("The classroom can't be deleted because it's related to another table."));
        }
    }
}
