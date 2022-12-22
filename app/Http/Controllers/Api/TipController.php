<?php

namespace App\Http\Controllers\Api;

use App\Models\Tip;
use App\Http\Requests\{StoreTipRequest, UpdateTipRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\TipResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class TipController extends ApiController
{
    public function __construct()
    {
        $this->resource = TipResource::class;
        $this->model = app(Tip::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreTipRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateTipRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
