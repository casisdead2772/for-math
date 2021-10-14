@extends('layouts.app')
@section('solve-exercise')
    <div class="container">
        <div class="card position-relative overflow-hidden bg-light">
            <div class="card-header">
                Exercise №{{ $exercise->id }}
            </div>
            <div class="card-body justify-content-between">
                <h3>{{ $exercise->name }}</h3>
                <p class="card-text">{{ $exercise->task }}</p>
            </div>
            {{ $exercise->files }}
            @foreach($exercise->files as $file)
                <img src="{{ asset('storage/'.$file->file_path) }}">
                @endforeach()

        </div>
    </div>

@endsection()
