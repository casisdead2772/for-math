@extends('layouts.app')
@section('exercise')
<div class="container justify-content-center">
    <div class="p-4 p-md-5 mb-4 rounded">
        <form method="POST" action="{{route('exercises.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Task name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="subject">Choose subject</label>
                <select class="form-control" name="subject">
                    @foreach($subjects as $subject)
                        @if($subject->id === (int)old('subject'))
                            <option selected value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @else
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endif
                    @endforeach
                 </select>
            </div>
            <div class="form-group">
                <label for="task">Description</label>
                <textarea class="form-control" name="task" rows="3">{{ old('task') }}</textarea>
            </div>
            <div class="form-group">
                <label for="difficulty">Choose difficulty</label>
                <select class="form-control" name="difficulty">
                    <option @if((int)old('difficulty') === 1) selected @endif>1</option>
                    <option @if((int)old('difficulty') === 2) selected @endif>2</option>
                    <option @if((int)old('difficulty') === 3) selected @endif>3</option>
                    <option @if((int)old('difficulty') === 4) selected @endif>4</option>
                    <option @if((int)old('difficulty') === 5) selected @endif>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="answer">Answer</label>
                <input class="form-control" name="answers[]" value="{{ old('answers[0]') }}"/>
            </div>
            <div class="form-group">
                <label for="answer2">Answer 2 (optional)</label>
                <input class="form-control" name="answers[]" value="{{ old('answers[1]') }}"/>
            </div>
            <div class="form-group">
                <label for="answer3">Answer 3 (optional)</label>
                <input class="form-control" name="answers[]" value="{{ old('answers[2]') }}"/>
            </div>
            <div class="form-group">
                <input type="file" name="files[]" class="dropzone" multiple accept="image/jpeg,image/png,image/gif"   >
            </div>
            <div class="col-auto d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#MyModal">Create exercise</button>
            </div>
            <x-modal id="" title="Creating exercise">
                <div class="alert alert-primary" role="alert">
                    Are you sure you want to do this?
                </div>
            </x-modal>
        </form>
    </div>
</div>
@endsection
