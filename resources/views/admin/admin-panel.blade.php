@extends('layouts.app')
@section('admin')
    <div class="container m-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Count of exercises</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td> {{$user->exercises->count()}}</td>
                <td>
                    <form action="{{ route('user.show', $user->id) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-success mb-3">Show</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
