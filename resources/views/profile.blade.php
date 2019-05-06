@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-header-img">
                            <img class="rounded-circle" src="{{ asset('storage/img').'/'.$user->avatar }}" />
                        </div>
                        <br>
                        <h5 class="card-title" style="text-align:center;">
                            {{$user->name}}
                        </h5>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header ">Personal Information</div>
                    <div class="card-body">
                        <div class="card-title"> Email: {{$user->email}} </div>
                        <div class="card-title"> Phone Number: {{$user->phone}} </div>
                        <div class="card-title"> Date Of Birth: {{$user->phone}} </div>
                        <hr>
                        <div class="card-title"> Total stories: {{$user->posts->count()}} </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Change your profile picture</div>
                    <div class="card-body">
                        <form action="/profile" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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
    
                <div class="card-columns">
                    @foreach ($posts->where('user_id', Auth::user()->id) as $ownerPost)
                            <div class="card">
                                <div class="card-style">
                                    <a href="{{ route('post.show', $ownerPost->id) }}" >
                                    <img class="card-img-top" src="{{ asset('storage/img/story').'/'.$ownerPost->url }}" alt="Story Cover">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{$ownerPost->title}}
                                            </h5>
                                            <div class="card-text">{{$ownerPost->body}}</div>   
                                        </div>
                                    </a>
                                </div>
                            </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection