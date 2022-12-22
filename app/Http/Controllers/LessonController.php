<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\{StoreLessonRequest, UpdateLessonRequest};
use Yajra\DataTables\Facades\DataTables;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lesson view')->only('index', 'show');
        $this->middleware('permission:lesson create')->only('create', 'store');
        $this->middleware('permission:lesson edit')->only('edit', 'update');
        $this->middleware('permission:lesson delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $lessons = Lesson::with('unit:id,name', );

            return DataTables::of($lessons)
                ->addColumn('name', function($row){
                    return str($row->name)->limit(100);
                })
				->addColumn('description', function($row){
                    return str($row->description)->limit(100);
                })
				->addColumn('unit', function ($row) {
                    return $row->unit ? $row->unit->name : '';
                })->addColumn('action', 'lessons.include.action')
                ->toJson();
        }

        return view('lessons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonRequest $request)
    {
        
        Lesson::create($request->validated());

        return redirect()
            ->route('lessons.index')
            ->with('success', __('The lesson was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        $lesson->load('unit:id,name', );

		return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        $lesson->load('unit:id,name', );

		return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        
        $lesson->update($request->validated());

        return redirect()
            ->route('lessons.index')
            ->with('success', __('The lesson was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        try {
            $lesson->delete();

            return redirect()
                ->route('lessons.index')
                ->with('success', __('The lesson was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('lessons.index')
                ->with('error', __("The lesson can't be deleted because it's related to another table."));
        }
    }
}
