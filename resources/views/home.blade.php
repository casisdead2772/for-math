@extends('layouts.app')

@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-blend-lighten">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 font-weight-normal">Welcome to ForMath</h1>
            <p class="lead font-weight-normal">Here you can solve and post your tasks for solving</p>
            <a class="btn btn-outline-secondary" href="/exercises">Show exercises</a>
        </div>
    </div>

    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
        <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
            <div class="my-3 py-3">
                <h2 class="display-5">Best authors</h2>
                <p class="lead">Coming soon</p>
            </div>
            <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
        </div>
        <div class="bg-primary mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
            <div class="my-3 py-3">
                <h2 class="display-5">Best exercises</h2>
                <p class="lead">Coming soon.</p>
            </div>
            <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
        </div>
    </div>


@endsection
