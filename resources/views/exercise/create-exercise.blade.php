@extends('layouts.app')
@section('exercise')

<div class="container justify-content-center">
    <div class="p-4 p-md-5 mb-4 rounded">
        <form method="POST" action="{{route('exercises.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Task name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="subject">Choose subject</label>
                <select class="form-control" name="subject">
                    @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                 </select>
            </div>
            <div class="form-group">
                <label for="task">Description</label>
                <textarea class="form-control" name="task" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="answer">Answer</label>
                <input class="form-control" name="answer" rows="3"/>
            </div>
            <div class="col-auto d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#modal">Create exercise</button>
            </div>
            <x-modal title="Creating exercise">
                <div class="alert alert-danger" role="alert">
                    Are you sure you want to do this?
                </div>
            </x-modal>
        </form>
    </div>
</div>
@endsection
