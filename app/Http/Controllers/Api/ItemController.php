<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Requests\{StoreItemRequest, UpdateItemRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\ItemResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

use Image;

class ItemController extends ApiController
{
    public function __construct()
    {
        $this->resource = ItemResource::class;
        $this->model = app(Item::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreItemRequest $request)
    {

        $attr = $request->validated();
        
        if ($request->file('image') && $request->file('image')->isValid()) {

            $path = storage_path('app/public/uploads/images/');
            $filename = $request->file('image')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('image')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
				$constraint->aspectRatio();
            })->save($path . $filename);

            $attr['image'] = $filename;
        }

        $model = $this->repositry->save( $attr );


        if ($model) {
            return $this->returnData( 'data' , new $this->resource( $model ), __('Succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to create !'));
    }

    public function edit($id, UpdateItemRequest $request)
    {
        $item = $this->repositry->getByID($id);

        $attr = $request->validated();
        
        if ($request->file('image') && $request->file('image')->isValid()) {

            $path = storage_path('app/public/uploads/images/');
            $filename = $request->file('image')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('image')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
				$constraint->aspectRatio();
            })->save($path . $filename);

            // delete old image from storage
            if ($item->image != null && file_exists($path . $item->image)) {
                unlink($path . $item->image);
            }

            $attr['image'] = $filename;
        }


        if ($item) {
            $item = $this->repositry->edit( $id,$attr );
            return $this->returnData('data', new $this->resource( $item ), __('Updated succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));
    }
}
