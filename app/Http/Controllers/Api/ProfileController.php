<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use App\Http\Requests\{StoreProfileRequest, UpdateProfileRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\ProfileResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

class ProfileController extends ApiController
{
    public function __construct()
    {
        $this->resource = ProfileResource::class;
        $this->model = app(Profile::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreProfileRequest $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, UpdateProfileRequest $request)
    {
        return $this->update($id, $request->all());
    }
}
