@extends('layouts.base')

@section('body')
    <div class="container">
            <div class="jumbotron mt-5">
                <h1 class="display-3">Url Shortner</h1>
                <p class="lead">Input link for shorten</p>
                <hr class="my-4">
                @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }} new short link - {{ session('shortLink') }}
                </div>
                @endif
                <form action="/handle-new-link" class="input-group input-group-lg" method="post">
                    @csrf
                    <input name="original_link" type="text" class="form-control" placeholder="url">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Short</button>
                    </div>
                </form>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
