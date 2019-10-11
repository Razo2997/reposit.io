@extends('layouts.app')
@section('content')
    @foreach($posts as $post)
        <div class="container p-3" style="border: 1px solid blue; border-radius:10px;">
            <div class="row justify-content-between">
                <div class="col-md-4 mt-3 ">
                    <img src="{{asset('postImage/'.$post->image)}}" class="w-100 ">
                </div>
                <p class="text-right col-md-8">created at {{$post->created_at}}</p>
            </div>
            <h2><small>title: </small>{{$post->title}}</h2>
            <h4><small>subtitle: </small>{{$post->subtitle}}</h4>
            <div class="text border">
                <p>text</p>
                <p>{{$post->text}}</p>
            </div>
        </div>




    @endforeach







@endsection
