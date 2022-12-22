<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use App\Http\Requests\{StoreSubjectRequest, UpdateSubjectRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\SubjectResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class SubjectController extends ApiController
{
    public function __construct()
    {
        $this->resource = SubjectResource::class;
        $this->model = app(Subject::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreSubjectRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateSubjectRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
