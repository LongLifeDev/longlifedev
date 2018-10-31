@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div class="col-md-4 col-sm-4">
            <img style="width:85%" src="/storage/cover_images/{{$post->cover_image}}">
    </div>
    <br>
    <hr>
    <div>
        <!--Added  double ! to parse html inbedded in ckeditor -->
        <h4>{!!$post->body!!}</h4>
    </div>
    <hr>
    <small>Written by <b>{{$post->user->name}}</b>. On {{$post->created_at}}}</small>
    <hr>
    <!-- Only show edit and delete button to auth logged users, no guests.-->
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id) 
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close() !!}
        @endif
    @endif
@endsection