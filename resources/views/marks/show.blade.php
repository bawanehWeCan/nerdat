@extends('layouts.app')

@section('title', __('Detail of Marks'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Marks') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of mark.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('marks.index') }}">{{ __('Marks') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                            <td class="fw-bold">{{ __('Is Correct') }}</td>
                                            <td>{{ $mark->is_correct }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Question') }}</td>
                                        <td>{{ $mark->question ? $mark->question->question : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Answer') }}</td>
                                        <td>{{ $mark->answer ? $mark->answer->description : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Result') }}</td>
                                        <td>{{ $mark->result ? $mark->result->name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $mark->user ? $mark->user->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $mark->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $mark->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
