<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Http\Requests\{StoreBlogRequest, UpdateBlogRequest};
use BawanehWeCan\Generator\Repositories\Repository;
use App\Http\Resources\BlogResource;

use BawanehWeCan\Generator\Http\Controllers\ApiController;

use Image;

class BlogController extends ApiController
{
    public function __construct()
    {
        $this->resource = BlogResource::class;
        $this->model = app(Blog::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save(StoreBlogRequest $request)
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

    public function edit($id, UpdateBlogRequest $request)
    {
        $blog = $this->repositry->getByID($id);

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
            if ($blog->image != null && file_exists($path . $blog->image)) {
                unlink($path . $blog->image);
            }

            $attr['image'] = $filename;
        }


        if ($blog) {
            $blog = $this->repositry->edit( $id,$attr );
            return $this->returnData('data', new $this->resource( $blog ), __('Updated succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));
    }
}
