@extends('layouts.app')
@section('edit-exercise')
    <div class="container justify-content-center">
        <div class="p-4 p-md-5 mb-4 rounded">
            <form method="POST" action="{{ route('exercises.update', $exercise->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Task name</label>
                    <input type="text" class="form-control" name="name" value="{{ $exercise->name }}">
                </div>
                <div class="form-group">
                    <label for="subject">Choose subject</label>
                    <select class="form-control" name="subject">
                        @foreach($subjects as $subject)
                            @if($subject->id === $exercise->subject_id)
                            <option selected value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @else
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="task">Description</label>
                    <textarea class="form-control" name="task" rows="3">{{ $exercise->task }}</textarea>
                </div>
                <div class="form-group">
                    <label for="answer">Answer</label>
                    <input value="{{ $exercise->answer }}" class="form-control" name="answer" rows="3"/>
                </div>
                <div class="col-auto d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary mb-3">Edit exercise</button>
                </div>
            </form>
        </div>
    </div>
@endsection
