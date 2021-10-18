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
                    <label for="difficulty">Choose difficulty</label>
                    <select class="selectpicker" name="difficulty">
                        <option @if($exercise->difficulty === 1) selected @endif>1</option>
                        <option @if($exercise->difficulty === 2) selected @endif>2</option>
                        <option @if($exercise->difficulty === 3) selected @endif>3</option>
                        <option @if($exercise->difficulty === 4) selected @endif>4</option>
                        <option @if($exercise->difficulty === 5) selected @endif>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Choose some tags</label>
                    <select class="form-control selectpicker" name="tags[]" multiple data-live-search="true">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @if($exercise->tags->where('name', $tag->name)->first()) @endif>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="answer">Answer</label>
                    <input class="form-control" name="answers[]" value="{{ $exercise->answers[0]->title }}"/>
                </div>
                @if(isset($exercise->answers[1]))
                <div class="form-group">
                    <label for="answer2">Answer 2 (optional)</label>
                    <input class="form-control" name="answers[]" value="{{ $exercise->answers[1]->title }}"/>
                </div>
                @endif

                <div class="form-group">
                    <label for="answer3">Answer 3 (optional)</label>
                    @if(isset($exercise->answers[2]))
                    <input class="form-control" name="answers[]" value="{{ $exercise->answers[2]->title }}"/>
                        @else()
                    @endif
                </div>
                <div class="col-auto d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary mb-3">Edit exercise</button>
                </div>
            </form>
        </div>
    </div>
@endsection
