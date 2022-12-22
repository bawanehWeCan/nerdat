<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use App\Models\SchoolGrade;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['users.create', 'users.edit'], function ($view) {
            return $view->with(
                'roles',
                Role::select('id', 'name')->get()
            );
        });

        View::composer(['classrooms.create', 'classrooms.edit'], function ($view) {
            return $view->with(
                'schoolGrades',
                SchoolGrade::select('id', 'name')->get()
            );
        });


				View::composer(['subjects.create', 'subjects.edit'], function ($view) {
            return $view->with(
                'classrooms',
                \App\Models\Classroom::select('id', 'name')->get()
            );
        });

				View::composer(['units.create', 'units.edit'], function ($view) {
            return $view->with(
                'subjects',
                \App\Models\Subject::select('id', 'name')->get()
            );
        });

				View::composer(['lessons.create', 'lessons.edit'], function ($view) {
            return $view->with(
                'units',
                \App\Models\Unit::select('id', 'name')->get()
            );
        });

				View::composer(['questions.create', 'questions.edit'], function ($view) {
            return $view->with(
                'subjects',
                \App\Models\Subject::select('id', 'name')->get()
            );
        });

		View::composer(['questions.create', 'questions.edit'], function ($view) {
            return $view->with(
                'lessons',
                \App\Models\Lesson::select('id', 'name')->get()
            );
        });

		View::composer(['questions.create', 'questions.edit'], function ($view) {
            return $view->with(
                'units',
                \App\Models\Unit::select('id', 'name')->get()
            );
        });

				View::composer(['answers.create', 'answers.edit'], function ($view) {
            return $view->with(
                'questions',
                \App\Models\Question::select('id', 'question')->get()
            );
        });

		View::composer(['results.create', 'results.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

		View::composer(['marks.create', 'marks.edit'], function ($view) {
            return $view->with(
                'questions',
                \App\Models\Question::select('id', 'question')->get()
            );
        });

		View::composer(['marks.create', 'marks.edit'], function ($view) {
            return $view->with(
                'answers',
                \App\Models\Answer::select('id', 'description')->get()
            );
        });

		View::composer(['marks.create', 'marks.edit'], function ($view) {
            return $view->with(
                'results',
                \App\Models\Result::select('id', 'name')->get()
            );
        });

		View::composer(['marks.create', 'marks.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

				View::composer(['profiles.create', 'profiles.edit'], function ($view) {
            return $view->with(
                'classrooms',
                \App\Models\Classroom::select('id', 'name')->get()
            );
        });

		View::composer(['profiles.create', 'profiles.edit'], function ($view) {
            return $view->with(
                'schoolGrades',
                \App\Models\SchoolGrade::select('id', 'name')->get()
            );
        });

		View::composer(['profiles.create', 'profiles.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

	}
}