<?php

namespace App\Http\Controllers\Api;

use App\Models\Result;
use App\Http\Requests\{StoreResultRequest, UpdateResultRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\ResultResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class ResultController extends ApiController
{
    public function __construct()
    {
        $this->resource = ResultResource::class;
        $this->model = app(Result::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreResultRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateResultRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
