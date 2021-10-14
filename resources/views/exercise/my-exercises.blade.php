@extends('layouts.app')
@section('my-exercises')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="list-group">
                    @foreach ($myExercises as $exercise)
                        <li class="list-group-item">
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
                                <button type="button" data-toggle="modal" data-target="#MyModal{{ $exercise->id }}" class="btn btn-danger mb-3">Delete</button>
                                    <x-modal id="{{ $exercise->id }}" title="Creating exercise">
                                        <div class="alert alert-primary" role="alert">
                                            Are you sure you want to do this?
                                        </div>
                                    </x-modal>
                                </form>
                                <form action="{{ route('exercises.show', $exercise->id) }}" method="GET">
                                    @csrf
                                <button type="submit" class="btn btn-info mb-3">Show</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
