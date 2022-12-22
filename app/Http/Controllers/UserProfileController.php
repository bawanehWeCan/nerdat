<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\{StoreProfileRequest, UpdateProfileRequest};
use Yajra\DataTables\Facades\DataTables;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profile view')->only('index', 'show');
        $this->middleware('permission:profile create')->only('create', 'store');
        $this->middleware('permission:profile edit')->only('edit', 'update');
        $this->middleware('permission:profile delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $profiles = Profile::with('classroom:id,name', 'school_grade:id,name', 'user:id,name', );

            return DataTables::of($profiles)
                ->addColumn('lname', function($row){
                    return str($row->lname)->limit(100);
                })
				->addColumn('phone', function($row){
                    return str($row->phone)->limit(100);
                })
				->addColumn('gender', function($row){
                    return str($row->gender)->limit(100);
                })
				->addColumn('classroom', function ($row) {
                    return $row->classroom ? $row->classroom->name : '';
                })->addColumn('school_grade', function ($row) {
                    return $row->school_grade ? $row->school_grade->name : '';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '';
                })->addColumn('action', 'profiles.include.action')
                ->toJson();
        }

        return view('profiles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {

        Profile::create($request->validated());

        return redirect()
            ->route('profiles.index')
            ->with('success', __('The profile was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $profile->load('classroom:id,name', 'school_grade:id,name', 'user:id,name', );

		return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $profile->load('classroom:id,name', 'school_grade:id,name', 'user:id,name', );

		return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {

        $profile->update($request->validated());

        return redirect()
            ->route('profiles.index')
            ->with('success', __('The profile was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        try {
            $profile->delete();

            return redirect()
                ->route('profiles.index')
                ->with('success', __('The profile was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('profiles.index')
                ->with('error', __("The profile can't be deleted because it's related to another table."));
        }
    }
}
