<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\{StoreBlogRequest, UpdateBlogRequest};
use Yajra\DataTables\Facades\DataTables;
use Image;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:blog view')->only('index', 'show');
        $this->middleware('permission:blog create')->only('create', 'store');
        $this->middleware('permission:blog edit')->only('edit', 'update');
        $this->middleware('permission:blog delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $blogs = Blog::query();

            return Datatables::of($blogs)
                ->addColumn('title', function($row){
                    return str($row->title)->limit(100);
                })
				->addColumn('description', function($row){
                    return str($row->description)->limit(100);
                })
				->addColumn('image', function($row){
                    return str($row->image)->limit(100);
                })
				
                ->addColumn('image', function ($row) {
                    if ($row->image == null) {
                    return 'https://via.placeholder.com/350?text=No+Image+Avaiable';
                }
                    return asset('storage/uploads/images/' . $row->image);
                })

                ->addColumn('action', 'blogs.include.action')
                ->toJson();
        }

        return view('blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
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

        Blog::create($attr);

        return redirect()
            ->route('blogs.index')
            ->with('success', __('The blog was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
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

            // delete old image from storage
            if ($blog->image != null && file_exists($path . $blog->image)) {
                unlink($path . $blog->image);
            }

            $attr['image'] = $filename;
        }

        $blog->update($attr);

        return redirect()
            ->route('blogs.index')
            ->with('success', __('The blog was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        try {
            $path = storage_path('app/public/uploads/images/');

            if ($blog->image != null && file_exists($path . $blog->image)) {
                unlink($path . $blog->image);
            }

            $blog->delete();

            return redirect()
                ->route('blogs.index')
                ->with('success', __('The blog was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('blogs.index')
                ->with('error', __("The blog can't be deleted because it's related to another table."));
        }
    }
}
