@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth::check())
            <div class="card mb-3">
                <div class="card-header">Hello {{ Auth::user()->name }}, tell us your story!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            <input 
                            type="text" 
                            name="title" 
                            class="form-control" 
                            required 
                            placeholder="Title"/>
                        </div>
                        <div class="form-group">
                            <textarea 
                            name="body" 
                            rows="3" 
                            cols="30" 
                            class="form-control" 
                            required 
                            placeholder="Tell us about your story"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="url" id="url" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">Upload a story cover.</small>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" />
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <div class="card-columns">
                @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-style">
                                @if(Auth::check())
                                    <a href="{{ route('post.show', $post->id) }}" >
                                        <img class="card-img-top" src="{{ asset('storage/img/story').'/'.$post->url }}" alt="Story Cover">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{$post->title}}
                                            </h5>
                                            <div class="card-text">{{$post->body}}</div>
                                            <hr>
                                            <p class="card-text"><small class="text-muted"> {{$post->comments->count()}} comments </small></p>   
                                        </div>
                                    </a>
                                @else
                                    <a href="#" onclick="alert('You have to register to see story detail!');">
                                        <img class="card-img-top" src="{{ asset('storage/img/story').'/'.$post->url }}" alt="Story Cover">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{$post->title}}
                                            </h5>
                                            <div class="card-text">{{$post->body}}</div>
                                            <hr>
                                            <p class="card-text"><small class="text-muted">{{$post->comments->count()}} comments</small></p>  
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div> 
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <form action="/search" enctype="multipart/form-data" method="GET">
                <div class="input-group">
                    <input type="search" name="search" id="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
