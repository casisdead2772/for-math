@extends('layouts.app')
@section('exercise')
    <div class="container p-2">
        <div class="container">
            <div class="form-group">
                <input class="form-control" id="search" name="search" type="text" placeholder="Search..">
            </div>
            <form method="GET" action="{{ route('exercises.index') }}">
            <label for="subject">Choose subject</label>
                <select class="form-control" name="subject_id">
                    <option value="0">All</option>
                    @foreach($subjects as $subject)
                        @if($subject->id === (int)request()->get('subject_id'))
                            <option selected value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @else
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endif
                    @endforeach
                </select>
                <select class="form-control" name="sort">
                    <option value="name" @if(request()->get('sort') === 'name') selected @endif>Name</option>
                    <option value="difficulty" @if(request()->get('sort') === 'difficulty') selected @endif>Difficulty</option>
                    <option value="created_at" @if(request()->get('sort') === 'created_at') selected @endif>Created At</option>
                </select>
                <button type="submit" class="btn btn-light">Фильтровать</button>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="list-group p-2 m-2">
                    @foreach ($exercises as $exercise)
                    <a class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Task: {{ $exercise->name }}</h5>
                        <small> {{ $exercise->created_at }}</small>
                        </div>
                        <p class="mb-1">{{ $exercise->task }}</p>
                        <div class="d-flex position-relative justify-content-between">
                            <div class="row align-items-center">
                        <small>Author: {{ $exercise->username }}</small>
                            </div>
                            <h2>{{ $exercise->difficulty }}</h2>
                        <form action="{{ route('exercises.show', $exercise->id) }}" method="GET">
                            @csrf
                                <button type="submit" class="btn btn-info mb-3 justify-content-end">Show</button>

                        </form>
                        </div>
                    </a>
                    @endforeach
                    <div class="d-flex justify-content-center">
                            {{ $exercises->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '/exercise',
                data:{'search':$value},
                success:function(data){
                    console.log(data)
                    $('tbody').html(data);
                }
            });
        })
    </script>
@endsection
