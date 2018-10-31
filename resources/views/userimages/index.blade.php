@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
    <h1>User Images<a href="/userimages/create" class="btn btn-primary">Upload Image</a></h1>
    @else
    <h1>User Images</h1>
    @endif
    @if(count($userimages)> 0)
        @for($i=0; $i < count($userimages);$i=$i+3)
            
            <div class="well">
                <div class="row"> 
                    <div class="col-md-4 col-sm-4">
                        <h3><a href="/userimages/{{$userimages[$i]->id}}">{{$userimages[$i]->title}}</a></h3>
                        <a href="/userimages/{{$userimages[$i]->id}}"><img class="img-responsive img-rounded" style="width:auto" src="/storage/user_images/{{$userimages[$i]->image}}"></a> 
                        
                        <small>Posted by <b>{{$userimages[$i]->user->name}}</b>. On {{$userimages[$i]->created_at}} </small>
                    </div>
                    @if(count($userimages[$i+1]) > 0)
                    <div class="col-md-4 col-sm-4">
                            <h3><a href="/userimages/{{$userimages[$i+1]->id}}">{{$userimages[$i+1]->title}}</a></h3>
                        <a href="/userimages/{{$userimages[$i+1]->id}}"><img class="img-responsive img-rounded" style="width:auto" src="/storage/user_images/{{$userimages[$i+1]->image}}"></a> 
                        
                        <small>Posted by <b>{{$userimages[$i+1]->user->name}}</b>. On {{$userimages[$i+1]->created_at}} </small>
                    </div>
                    @endif
                    @if(count($userimages[$i+2]) > 0)
                    <div class="col-md-4 col-sm-4">
                        <h3><a href="/userimages/{{$userimages[$i+2]->id}}">{{$userimages[$i+2]->title}}</a></h3>
                        <a href="/userimages/{{$userimages[$i+2]->id}}"><img class="img-responsive img-rounded" style="width:auto" src="/storage/user_images/{{$userimages[$i+2]->image}}"></a>
                        
                        <small>Posted by <b>{{$userimages[$i+2]->user->name}}</b>. On {{$userimages[$i+2]->created_at}} </small>
                    </div>
                    @endif
                </div>
                
            </div>
             
        @endfor
        {{$userimages->links()}}
    @else  
        <p>No images found</p>
    @endif 
    
@endsection



