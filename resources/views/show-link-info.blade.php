@extends('layouts.base')

@section('body')
    <div class="container">
        <div class="jumbotron mt-5">
            <h1 class="display-3">Link information: </h1>
            <hr class="my-4">
            <h2>Original link: {{$link->original_link}}</h2>
            <h2>Short link: {{$link->short_link}}</h2>
        </div>
    </div>
@endsection