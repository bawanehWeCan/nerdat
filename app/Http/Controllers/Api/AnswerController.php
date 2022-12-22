<?php

namespace App\Http\Controllers\Api;

use App\Models\Answer;
use App\Http\Requests\{StoreAnswerRequest, UpdateAnswerRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\AnswerResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class AnswerController extends ApiController
{
    public function __construct()
    {
        $this->resource = AnswerResource::class;
        $this->model = app(Answer::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreAnswerRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateAnswerRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
