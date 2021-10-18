@extends('layouts.app')
@section('exercise')
<div class="container p-2 bg-light rounded">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @foreach ($exercises as $exercise)
                    <div class="row d-flex justify-content-center">
                            <div class="card d-flex w-100 mb-4 box-shadow h-md-250">
                                <div class="card-body d-flex flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between d-inline-block">
                                        <strong class="d-inline-block mb-2 text-success">{{ $exercise->subject->name }}</strong>
                                        <small> <rating :id="{{ $exercise->id }}" :readonly="true"></rating></small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between align-items-center d-inline-block">
                                    <h3 class="mb-0">
                                        <a class="text-dark">Task: {{ $exercise->name }}</a>
                                    </h3>
                                        <h4 class="mb-0">
                                        <a class="text-dark">Difficulty: {{ $exercise->difficulty  }}</a>
                                        </h4>
                                    </div>
                                    <div class="mb-1 text-muted">{{ $exercise->created_at }}</div>
                                    <p class="card-text mb-auto">{{ $exercise->task }}</p>
                                    <div class="d-flex w-100 justify-content-between d-inline-block">
                                        <a>Author: {{ $exercise->user->name }}</a>
                                        <form action="{{ route('exercises.show', $exercise->id) }}" method="GET">
                                            @csrf
                                                <button type="submit" class="btn btn-info mb-3 justify-content-end">Show</button>

                                        </form>
                                        </div>
                                    @if(isset($exercise->results->where('user_id', auth()->user()->id)->first()->status))
                                        @if($exercise->results->where('user_id', auth()->user()->id)->first()->status)
                                            <i title="You resolve this exercise" class="far fa-check-square fa-lg mx-2"></i>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                @endforeach
                <div class="d-flex justify-content-center">
                        {{ $exercises->appends(request()->except('page'))->links() }}
                </div>

        </div>
        <div class="col-md-2">
                <form method="GET" action="{{ route('exercises.index') }}">
                    <input type="hidden" name="search_query" value="{{ request()->get('search_query') }}">
                    <label for="subject">Choose subject</label>
                    <select class="form-control mb-2" name="subject_id">
                        <option value="0">All</option>
                        @foreach($subjects as $subject)
                            @if($subject->id === (int)request()->get('subject_id'))
                               <option selected value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @else
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endif
                        @endforeach
                    </select>
                <label for="sort">Choose sort</label>
                <select class="form-control mb-2" name="sort">
                    <option value="rating" @if(request()->get('sort') === 'rating') selected @endif>Rating</option>
                    <option value="difficulty" @if(request()->get('sort') === 'difficulty') selected @endif>Difficulty</option>
                    <option value="created" @if(request()->get('sort') === 'created_at') selected @endif>Created At</option>
                </select>
                <button type="submit" class="btn btn-light">Filter</button>
            </form>
        </div>
    </div>
</div>
@endsection
