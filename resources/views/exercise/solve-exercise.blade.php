@extends('layouts.app')
@section('solve-exercise')
    <div class="container">
        <div class="card position-relative overflow-hidden bg-light">
            <div class="card-header">
                <div class="row justify-content-between">
                Exercise №{{ $exercise->id }}
                    @if(isset($results->status))
                        @if($results->status === 1)
                    <i class="far fa-check-square fa-lg mx-2"></i>
                        @endif
                    @endif
                </div>
            </div>


            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="px-3">
                        <h3>{{ $exercise->name }}</h3>
                    </div>
                    @if(isset($results->status))
                        @if($results->status === 1)
                        <small> <a>Please rate the exercise after resolving</a>
                            <rating :id="{{ $exercise->id }}"></rating></small>
                        @endif
                    @endif
                </div>
                <p class="card-text">{{ $exercise->task }}</p>
            </div>
            <div class="row justify-content-center">
            @foreach($exercise->files as $file)
                <div class="col-md-4 text-center align-self-center p-2"> <img src="{{ asset('storage/'.$file->file_path) }}" class="img-thumbnail rounded" style="max-width:300px;"> </div>
            @endforeach()
                </div>
            <form method="POST" action="{{route('result.store', ['id'=>$exercise->id])}}">
                @csrf
                <div class="row justify-content-center">
                    @if(isset($results->status))
                        @if($results->status !== 1)
                <div class="input-group m-3 col-8">
                    <input type="text" class="form-control" name="answer" placeholder="Answer" aria-label="Answer" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Try Answer</button>
                    </div>
                </div>
                        @endif
                    @endif
                </div>
            </form>
        </div>
    </div>

@endsection()
