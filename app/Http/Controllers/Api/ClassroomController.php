<?php

namespace App\Http\Controllers\Api;

use App\Models\Classroom;
use App\Http\Requests\{StoreClassroomRequest, UpdateClassroomRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\ClassroomResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class ClassroomController extends ApiController
{
    public function __construct()
    {
        $this->resource = ClassroomResource::class;
        $this->model = app(Classroom::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreClassroomRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateClassroomRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
