<?php

namespace App\Http\Controllers;

use App\Models\SchoolGrade;
use App\Http\Requests\{StoreSchoolGradeRequest, UpdateSchoolGradeRequest};
use Yajra\DataTables\Facades\DataTables;

class SchoolGradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:school grade view')->only('index', 'show');
        $this->middleware('permission:school grade create')->only('create', 'store');
        $this->middleware('permission:school grade edit')->only('edit', 'update');
        $this->middleware('permission:school grade delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $schoolGrades = SchoolGrade::query();

            return DataTables::of($schoolGrades)
                ->addColumn('name', function($row){
                    return str($row->name)->limit(100);
                })
				->addColumn('action', 'school-grades.include.action')
                ->toJson();
        }

        return view('school-grades.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school-grades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolGradeRequest $request)
    {
        
        SchoolGrade::create($request->validated());

        return redirect()
            ->route('school-grades.index')
            ->with('success', __('The schoolGrade was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolGrade  $schoolGrade
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolGrade $schoolGrade)
    {
        return view('school-grades.show', compact('schoolGrade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolGrade  $schoolGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolGrade $schoolGrade)
    {
        return view('school-grades.edit', compact('schoolGrade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolGrade  $schoolGrade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolGradeRequest $request, SchoolGrade $schoolGrade)
    {
        
        $schoolGrade->update($request->validated());

        return redirect()
            ->route('school-grades.index')
            ->with('success', __('The schoolGrade was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolGrade  $schoolGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolGrade $schoolGrade)
    {
        try {
            $schoolGrade->delete();

            return redirect()
                ->route('school-grades.index')
                ->with('success', __('The schoolGrade was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('school-grades.index')
                ->with('error', __("The schoolGrade can't be deleted because it's related to another table."));
        }
    }
}
