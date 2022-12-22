<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Http\Requests\{StoreMarkRequest, UpdateMarkRequest};
use Yajra\DataTables\Facades\DataTables;

class MarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:mark view')->only('index', 'show');
        $this->middleware('permission:mark create')->only('create', 'store');
        $this->middleware('permission:mark edit')->only('edit', 'update');
        $this->middleware('permission:mark delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $marks = Mark::with('question:id,question', 'answer:id,description', 'result:id,name', 'user:id,name');

            return DataTables::of($marks)
                ->addColumn('question', function ($row) {
                    return $row->question ? $row->question->question : '';
                })->addColumn('answer', function ($row) {
                    return $row->answer ? $row->answer->description : '';
                })->addColumn('result', function ($row) {
                    return $row->result ? $row->result->name : '';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '';
                })->addColumn('action', 'marks.include.action')
                ->toJson();
        }

        return view('marks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarkRequest $request)
    {
        
        Mark::create($request->validated());

        return redirect()
            ->route('marks.index')
            ->with('success', __('The mark was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        $mark->load('question:id,question', 'answer:id,description', 'result:id,name', 'user:id,name');

		return view('marks.show', compact('mark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        $mark->load('question:id,question', 'answer:id,description', 'result:id,name', 'user:id,name');

		return view('marks.edit', compact('mark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarkRequest $request, Mark $mark)
    {
        
        $mark->update($request->validated());

        return redirect()
            ->route('marks.index')
            ->with('success', __('The mark was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        try {
            $mark->delete();

            return redirect()
                ->route('marks.index')
                ->with('success', __('The mark was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('marks.index')
                ->with('error', __("The mark can't be deleted because it's related to another table."));
        }
    }
}
