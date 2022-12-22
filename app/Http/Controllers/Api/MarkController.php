<?php

namespace App\Http\Controllers\Api;

use App\Models\Mark;
use App\Http\Requests\{StoreMarkRequest, UpdateMarkRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\MarkResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class MarkController extends ApiController
{
    public function __construct()
    {
        $this->resource = MarkResource::class;
        $this->model = app(Mark::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreMarkRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateMarkRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
