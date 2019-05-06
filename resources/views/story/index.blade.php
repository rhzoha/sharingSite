@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <img class="card-img-top" src="{{ asset('storage/img/story').'/'.$post->url }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$post->title}}</h5>
              <p class="card-text">{{$post->body}}</p>

              @if (Auth::user()->id == $post->user_id)
                <form class="mb-3" action="{{ route('post.destroy',$post->id) }}" method="POST" enctype="multipart/form-data">
                    <a href="{{ route('post.edit',$post->id)}}" class="btn btn-primary">Edit</a>
      
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
      
                </form>
              @endif

              <span class="pb-3">{{$post->comments->count()}} {{ str_plural('comment', $post->comments->count()) }}</span>
              
              <div class="comment-area card-text mt-3">
                
                @foreach($post->comments as $comment)
                    <div class="display-comment">
                        <strong>{{ $comment->user->name }}</strong>
                        <p>{{ $comment->body }}</p>
                        {{-- @if (Auth::check())
                          @if(count((array) $post->comments) > 0)
                              @if($comment->user->id == Auth::user()->id)
                                  {!! Form::open(array('route' =>array('comment.destroy',$comment->id))) !!}
                                  {!! Form::hidden('_method', 'DELETE') !!}
                                  {!! Form::submit('Delete comment') !!}
                                  {!! Form::close() !!}
                                  <a href="{{ route('comment.destroy', $comment->id)}}"> <button type="submit">dlt</button> </a>
                              @endif
                          @endif
                        @endif --}}
                    </div>
                @endforeach
                
                <hr />
                <h4>Add comment</h4>
                <form method="POST" action="{{ route('comment.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="body" class="form-control" />
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="Add Comment" />
                    </div>
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
  </div>
@endsection