<?php

namespace App\Http\Controllers\Api;

use App\Models\SchoolGrade;
use App\Http\Requests\{StoreSchoolGradeRequest, UpdateSchoolGradeRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\SchoolGradeResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class SchoolGradeController extends ApiController
{
    public function __construct()
    {
        $this->resource = SchoolGradeResource::class;
        $this->model = app(SchoolGrade::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreSchoolGradeRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateSchoolGradeRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
