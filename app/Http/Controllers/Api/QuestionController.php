<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use App\Http\Requests\{StoreQuestionRequest, UpdateQuestionRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\QuestionResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class QuestionController extends ApiController
{
    public function __construct()
    {
        $this->resource = QuestionResource::class;
        $this->model = app(Question::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreQuestionRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateQuestionRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
