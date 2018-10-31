@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>LongLife Development</h1>
        <p>Welcome to the LongLife Dev Website. This web portal is our window to the world. We are a diverse group of web developers based near Seattle, Wa.. Our current product offerings include simple 3 page web design and deployment, medium sized websites and webapps, and web design and maintaince consulting. We are a new development group but our tech is also new and cutting edge. Give us a try!  </p>
        @if (Auth::guest())
        <p>Feel free to sign up for a free account below!</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
        @endif
    </div>
    <div class="jumbotron text-center">
            <h2><a href="/posts">Latest Blog Post.</a></h2>
            
            @foreach($posts as $post)
            
            <img style="width:33%" src="/storage/cover_images/{{$post->cover_image}}">
            <h3>{{$post->title}}</h3>
            <p>{!!$post->body!!}</p>
            <hr>
            <small>Written by <b>{{$post->user->name}}</b>. On {{$post->created_at}}}</small>
            @endforeach
        </div>
@endsection