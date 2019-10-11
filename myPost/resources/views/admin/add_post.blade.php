
@extends('admin.layouts.header-footer')
@section('admin-content')

    <div class=" w-50 ml-5 mt-5">
        <form action="{{route('add_post')}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Enter the title</label>
                <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}" placeholder="enter title">
                @if(session()->has('errors'))
                    <p class="text-danger">{{session('errors')->first('title')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="subtitle">Enter subtitle</label>
                <input class="form-control" value="{{old('subtitle')}}" type="text" id="subtitle" name="subtitle" placeholder="enter subtitle">
                @if(session()->has('errors'))
                    <p class="text-danger">{{session('errors')->first('subtitle')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Enter the text</label>
                <textarea class="form-control" type="text" id="text" name="text" placeholder="enter the text">{{old('text')}}</textarea>
                @if(session()->has('errors'))
                    <p class="text-danger">{{session('errors')->first('text')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image">Add picture</label>
                <input class="form-control" type="file" id="image" name="image" >
                @if(session()->has('errors'))
                    <p class="text-danger">{{session('errors')->first('image')}}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>
    </div>


@endsection
