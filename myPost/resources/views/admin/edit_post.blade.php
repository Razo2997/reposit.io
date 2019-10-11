@extends('admin.layouts.header-footer')
@section('css-content')



@endsection
@section('admin-content')
    <form action="{{route('update_post')}}" method="post" enctype="multipart/form-data">
        @csrf
        @foreach($posts as $post)
            <input type="hidden" name="id" value="{{$post->id}}">
            <div class="container border rounded p-5">
                <div class="form-group">
                    <div class="row justify-content-between align-items-end">
                        <img class="media-object rounded" style="width: 300px;height: 200px" src="{{asset('postImage/'.$post->image)}} ">
                        <div>
                            <button type="submit" class=" text-right btn btn-primary  px-5 rounded "><p class="h2 text-center">save</p> </button>
                        </div>

                    </div>

                </div>
                <div class="form-group">
                    <label for="title"><h3 class="text-dark">title</h3></label>
                    <input type="text" class="form-control" value="{{$post->title}}" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="title"><h3 class="text-dark">subtitle</h3></label>
                    <input type="text" class="form-control" value="{{$post->subtitle}}" id="subtitle" name="subtitle">
                </div>
                <div class="form-group">
                    <label for="title"><h3 class="text-dark">text</h3></label>
                    <textarea type="text" class="form-control"  id="text" name="text">{{$post->text}}</textarea>
                </div>
                <div class="form-group">
                    <label for="title"><h3 class="text-dark">image</h3></label>
                    <input type="file" class="form-control"  id="image" name="image">
                </div>


            </div>






        @endforeach
    </form>
















@endsection('admin-content)
