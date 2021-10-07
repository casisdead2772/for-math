@extends('layouts.app')
@section('my-exercises')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="list-group">
                    @foreach ($myExercises as $exercise)
                        <a class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Task: {{ $exercise->name }}</h5>
                                <small> {{ $exercise->created_at }}</small>
                            </div>
                            <p class="mb-1">{{ $exercise->task }}</p>
                            <small>{{ $exercise->user_id }}</small>
                            <div class="col-auto d-grid gap-2 d-md-flex justify-content-md-end">
                                <form action="{{ route('exercises.edit', $exercise->id) }}" method="GET">
                                    @csrf
                                <button type="submit" class="btn btn-success mb-3">Edit</button>
                                </form>
                                <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger mb-3">Delete</button>
                                </form>
                                <form action="{{ route('exercises.show', $exercise->id) }}" method="GET">
                                    @csrf
                                <button type="submit" class="btn btn-info mb-3">Show</button>
                                </form>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
