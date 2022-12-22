<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\{StoreItemRequest, UpdateItemRequest};
use Yajra\DataTables\Facades\DataTables;
use Image;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:item view')->only('index', 'show');
        $this->middleware('permission:item create')->only('create', 'store');
        $this->middleware('permission:item edit')->only('edit', 'update');
        $this->middleware('permission:item delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $items = Item::query();

            return Datatables::of($items)
                
                ->addColumn('image', function ($row) {
                    if ($row->image == null) {
                    return 'https://via.placeholder.com/350?text=No+Image+Avaiable';
                }
                    return asset('storage/uploads/images/' . $row->image);
                })

                ->addColumn('action', 'items.include.action')
                ->toJson();
        }

        return view('items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
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

        Item::create($attr);

        return redirect()
            ->route('items.index')
            ->with('success', __('The item was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
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
            if ($item->image != null && file_exists($path . $item->image)) {
                unlink($path . $item->image);
            }

            $attr['image'] = $filename;
        }

        $item->update($attr);

        return redirect()
            ->route('items.index')
            ->with('success', __('The item was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try {
            $path = storage_path('app/public/uploads/images/');

            if ($item->image != null && file_exists($path . $item->image)) {
                unlink($path . $item->image);
            }

            $item->delete();

            return redirect()
                ->route('items.index')
                ->with('success', __('The item was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('items.index')
                ->with('error', __("The item can't be deleted because it's related to another table."));
        }
    }
}
