@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <div class="card-text">
                        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          
                          <div class="form-group">
                              <input 
                              type="text" 
                              name="title" 
                              class="form-control" 
                              required 
                              value="{{$post->title}}"/>
                          </div>
                          <div class="form-group">
                              <textarea 
                              name="body" 
                              rows="3" 
                              cols="30" 
                              class="form-control" 
                              required>{{$post->body}}</textarea>
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
    </div>
@endsection