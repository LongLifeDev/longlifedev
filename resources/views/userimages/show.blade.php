@extends('layouts.app')

@section('content')
    <a href="/userimages" class="btn btn-default">Go Back</a>
    <h1>{{$image->title}}</h1>
    <div class="col-md-10 col-sm-10">
            <img style="width:90%" src="/storage/user_images/{{$image->image}}">
    </div>
    <br>
    <hr>
    <br/>
    <div class="col-md-10 col-sm-10" >
        <!--Added  double ! to parse html inbedded in ckeditor -->
        <h4>{!!$image->description!!}</h4>
        <hr>
        <small>Posted by <b>{{$image->user->name}}</b>. On {{$image->created_at}}}</small>
        <hr>
    </div>
    
    <!-- Only show edit and delete button to auth logged users, no guests.-->
    @if(!Auth::guest())
        @if(Auth::user()->id == $image->user_id) 
            {!!Form::open(['action' => ['UserimagesController@destroy', $image->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close() !!}
        @endif
    @endif
@endsection