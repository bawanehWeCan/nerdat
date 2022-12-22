<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use App\Http\Requests\{StoreLessonRequest, UpdateLessonRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\LessonResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class LessonController extends ApiController
{
    public function __construct()
    {
        $this->resource = LessonResource::class;
        $this->model = app(Lesson::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreLessonRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateLessonRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
