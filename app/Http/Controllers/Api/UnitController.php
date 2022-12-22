<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use App\Http\Requests\{StoreUnitRequest, UpdateUnitRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\UnitResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class UnitController extends ApiController
{
    public function __construct()
    {
        $this->resource = UnitResource::class;
        $this->model = app(Unit::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreUnitRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateUnitRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
