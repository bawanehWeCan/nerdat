<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Requests\{StoreAnswerRequest, UpdateAnswerRequest};
use App\Models\Question;
use Yajra\DataTables\Facades\DataTables;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:answer view')->only('index', 'show');
        $this->middleware('permission:answer create')->only('create', 'store');
        $this->middleware('permission:answer edit')->only('edit', 'update');
        $this->middleware('permission:answer delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $answers = Answer::with('question:id,question');

            return DataTables::of($answers)
                ->addColumn('description', function($row){
                    return str($row->description)->limit(100);
                })
				->addColumn('question', function ($row) {
                    return $row->question ? $row->question->question : '';
                })->addColumn('action', 'answers.include.action')
                ->toJson();
        }

        return view('answers.index');
    }

    public function answerByQuestion($q_id)
    {
        if (request()->ajax()) {
            $question = Question::find($q_id);

            // $answers = Answer::with('question:id,question');
            $answers = $question->answers;

            return DataTables::of($answers)
                ->addColumn('description', function($row){
                    return str($row->description)->limit(100);
                })
				->addColumn('question', function ($row) {
                    return $row->question ? $row->question->question : '';
                })->addColumn('action', 'answers.include.action')
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('answers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswerRequest $request)
    {

        Answer::create($request->validated());

        return redirect()
            ->route('answers.index')
            ->with('success', __('The answer was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        $answer->load('question:id,question');

		return view('answers.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        $answer->load('question:id,question');

		return view('answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {

        $answer->update($request->validated());

        return redirect()
            ->route('answers.index')
            ->with('success', __('The answer was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        try {
            $answer->delete();

            return redirect()
                ->route('answers.index')
                ->with('success', __('The answer was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('answers.index')
                ->with('error', __("The answer can't be deleted because it's related to another table."));
        }
    }
}
