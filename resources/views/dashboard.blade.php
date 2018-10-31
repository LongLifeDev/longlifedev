@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!--<div class="col-md-8 col-md-offset-2">-->
            <div class="col-md-8 col-md-8"> 
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/posts/create" class="btn btn-primary">Create post</a>
                    <h3>Your Blog posts</h3>
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else 
                        <p>You have no posts.</p>   
                    @endif

                    <a href="/userimages/create" class="btn btn-primary">Upload Image</a>
                    <h3>Your Images</h3>
                    @if(count($images) > 0)
                    <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($images as $image)
                            <tr>
                                <td>{{$image->title}}</td>
                                <td><a href="/userimages/{{$image->id}}" target="_blank"><img class="img-responsive img-rounded" style="width:20%" src="/storage/user_images/{{$image->image}}"></a></td>
                                    @if($image->is_profile == true)
                                        <td>PROFILE </td> 
                                    @endif
                                <td>
                                    {!!Form::open(['action' => ['UserimagesController@destroy', $image->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else 
                        <p>You have no Images.</p>   
                    @endif
                </div>
                
            </div>
        </div>
        <div class="col-md-4 col-md-4">
                <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>
        
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h3>Your Profile Information</h3>
                            @if(count($images) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <td>Profile Pic</td>
                                </tr>
                                @foreach($images as $image)
                                    <tr>
                                        @if(($image->is_profile) > 0)
                                        <td><img class="img-responsive img-rounded" style="width:40%" src="/storage/user_images/{{$image->image}}"></td>
                                        @endif
                                    </tr>
                                    
                                @endforeach
                                    <tr>
                                        <td><small>*delete previous profile pic to display new pic.</small></td>
                                    </tr>
                                
                            </table>
                            @else 
                                <p>You have no posts.</p>   
                            @endif
        
                            <a href="/userimages/create" class="btn btn-primary">Upload Image</a>
                            
                        </div>
                        
                    </div>
        </div>
    </div>
</div>
@endsection
