@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h1> Search Results: </h1>
          <hr>
          @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-style">
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
                </div>
            </div>
          @endforeach
          
        </div>
      </div>
  </div>
@endsection