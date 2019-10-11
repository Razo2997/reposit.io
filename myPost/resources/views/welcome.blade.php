@extends('layouts.app')
@section('css-content')
    <style>
        #place{
            display: flex;
            flex-wrap: wrap;
            margin: 0 auto;
            width: 80%;
            justify-content: space-evenly;
        }

        .card{
            border-radius: 10px;
        }
        .img{
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>




@endsection
@section('content')
    <div id="place" >
        @foreach($posts as $post)

            <div class="card m-3" style="width:25%">
                <a class="pull-left" href="{{route('post_page',$post->id)}}">
                    <img class="card-img-top img" src="{{asset('postImage/'.$post->image)}}" alt="Card image cap">
                </a>
                <div class="card-body">
                    <h4 class="card-title">{{$post->title}}</h4>
                    <p class="card-text">{{$post->text}}</p>
                </div>
            </div>






        @endforeach
    </div>




@endsection



@section('js-content')
    <script>
        $(document).ready(function () {
            let lazyLoadStep = 0;
            $(window).on("scroll", function() {

                let scrollHeight = $(document).height();
                let scrollPosition = $(window).height() + $(window).scrollTop();
                if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                    lazyLoadStep++;
                    $.ajax({
                        url: "/welcome/"+lazyLoadStep,
                        type: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            for(let i = 0; i < res["result"].length; i++){
                                let post = $('<div class="card m-3" style="width:25%"></div>');
                                let link = $('<a class="pull-left" href="/welcome/post/'+ res['result'][i]['id'] +'">');
                                let div_1 = $('<img class="card-img-top img" src="http://mypost.loc/postImage/'+ res['result'][i]['image'] +'" alt="Card image cap">');
                                let div_2 = $('<div class="card-body"></div>');
                                let div_3 = $('<h4 class="card-title">'+res["result"][i]["title"] +'</h4>');
                                let div_4 = $('<p class="card-text">'+ res["result"][i]["text"] +'</p>');
                                post.append(link,div_2);
                                link.append(div_1);
                                div_2.append(div_3,div_4);
                                $('#place').append(post);


                            }

                            console.log(res['result']);

                        }
                    });
                }

            });
        })
    </script>





@stop
