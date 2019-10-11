
@extends('admin.layouts.header-footer')
@section('admin-content')
    <div id="place">
    @foreach($posts as $post)


        <div class="well mr-auto w-75">
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object rounded" style="width: 240px;height: 160px" src="{{asset('postImage/'.$post->image)}} ">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$post->title}}</h4>
                    <p class="text-right">By Francisco</p>
                    <p>{{$post->subtitle}}</p>
                    <ul class="list-inline list-unstyled">
                        <li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li>
                        <li>|</li>
                        <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
                        <li>|</li>
                        <li>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                        </li>
                        <li>|</li>
                        <li>
                            <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                            <span><i class="fa fa-facebook-square"></i></span>
                            <span><i class="fa fa-twitter-square"></i></span>
                            <span><i class="fa fa-google-plus-square"></i></span>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-primary mx-2 mt-4"><a class="text-white" href="{{route('delete_post',$post->id)}}">Delete</a></button>

                <button class="btn btn-warning mt-4"><a class="text-white" href="{{route('edit_post',$post->id)}}">Edit</a></button>
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
                        url: "/admin/posts/"+lazyLoadStep,
                        type: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            for(let i = 0; i < res["result"].length; i++){
                                let post = '<div class="well mr-auto w-75">\n' +
                                    '            <div class="media">\n' +
                                    '                <a class="pull-left" href="#">\n' +
                                    '                    <img class="media-object rounded" style="width: 240px;height: 160px" src = "http://mypost.loc/postImage/'+ res['result'][i]['image'] +'">\n' +
                                    '                </a>\n' +
                                    '                <div class="media-body">\n' +
                                    '                    <h4 class="media-heading"> '+res["result"][i]["title"] +' </h4>\n' +
                                    '                    <p class="text-right">By Francisco</p>\n' +
                                    '                    <p>'+ res["result"][i]["subtitle"] +'</p>\n' +
                                    '                    <ul class="list-inline list-unstyled">\n' +
                                    '                        <li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li>\n' +
                                    '                        <li>|</li>\n' +
                                    '                        <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>\n' +
                                    '                        <li>|</li>\n' +
                                    '                        <li>\n' +
                                    '                            <span class="glyphicon glyphicon-star"></span>\n' +
                                    '                            <span class="glyphicon glyphicon-star"></span>\n' +
                                    '                            <span class="glyphicon glyphicon-star"></span>\n' +
                                    '                            <span class="glyphicon glyphicon-star"></span>\n' +
                                    '                            <span class="glyphicon glyphicon-star-empty"></span>\n' +
                                    '                        </li>\n' +
                                    '                        <li>|</li>\n' +
                                    '                        <li>\n' +
                                    '                            <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->\n' +
                                    '                            <span><i class="fa fa-facebook-square"></i></span>\n' +
                                    '                            <span><i class="fa fa-twitter-square"></i></span>\n' +
                                    '                            <span><i class="fa fa-google-plus-square"></i></span>\n' +
                                    '                        </li>\n' +
                                    '                    </ul>\n' +
                                    '                </div>\n' +
                                    '                  <button class="btn btn-primary mx-2 mt-4"><a class="text-white" href="/admin/delete-post/'+ res["result"][i]['id'] +'">Delete</a></button>\n' +
                                    '\n' +
                                    '                   <button class="btn btn-warning mt-4"><a class="text-white" href="/admin/edit-post/'+ res["result"][i]['id'] +'">Edit</a></button>            </div>\n' +
                                    '        </div>';
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
