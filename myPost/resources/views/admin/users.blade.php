@extends('admin.layouts.header-footer')
@section('css-content')
    <style>
        .cover{
            border: 1px solid black;
            border-radius: 5px;
        }
    </style>


@endsection
@section('admin-content')
    <div id="place">
        @foreach($users as $user)

            <div class="container mb-2 cover"  >
                <h4 class="role">{{$user->role}}</h4>
                <div class="row m-1 align-items-center w-100">
                    <h4 class="border border-dark rounded p-1 col-md-2"><small>name: </small>{{$user->name}}</h4>
                    <h4 class="ml-3 border border-dark rounded p-1 col-md-3"><small>email: </small>{{$user->email}}</h4>
                    <h4 class="ml-3 border border-dark rounded p-1 "><small>added: </small>{{$user->created_at}}</h4>
                    <h4 class="ml-3 border border-dark rounded p-1 col-md-2"> status: {{$user->status}}</h4>
                    @if($user->status === "active")
                        <button data-id="{{$user->id}}" class="ml-auto change" >Deactivate</button>

                    @else
                        <button data-id="{{$user->id}}" class="ml-auto change" >Activate</button>

                    @endif



                </div>


            </div>




        @endforeach
    </div>




@endsection



@section('js-content')
    <script>
        $(document).ready(function () {
            function setStatus(id,status){

                $.ajax({
                    url: "/admin/set-status/"+id,
                    type: 'GET',
                    dataType: 'json',
                    data:{
                        status:status
                    },
                    success:function (res) {

                    },
                    error:function (res) {

                    }

                })
            }
            $('.change').click(function () {
                if($(this).text() === 'Activate'){
                    setStatus($(this).data('id'),'active');
                    $(this).text('Deactivate');
                    $(this).prev().text('status: active')
                }
                else{
                    setStatus($(this).data('id'),'inactive');
                    $(this).text('Activate');
                    $(this).prev().text('status: inactive')
                }
            });

            let lazyLoadStep = 0;

            $(window).on("scroll", function() {

                let scrollHeight = $(document).height();
                let scrollPosition = $(window).height() + $(window).scrollTop();
                if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                    lazyLoadStep++;
                    $.ajax({
                        url: "/admin/users/"+lazyLoadStep,
                        type: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            for(let i = 0; i < res["result"].length; i++){
                                let but ;
                                if(res["result"][i]['status'] === 'active'){
                                    but = $('<button data-id="'+ res["result"][i]['id'] +'"  class="ml-auto change" >Deactivate</button>');
                                }
                                else{
                                    but = $('<button data-id="'+ res["result"][i]['id'] +'"  class="ml-auto change " >Activate</button>');
                                }
                                but.click(function () {
                                    if($(this).text() === 'Activate'){
                                        setStatus($(this).data('id'),'active');
                                        $(this).text('Deactivate');
                                        $(this).prev().text('status: active')
                                    }
                                    else{
                                        setStatus($(this).data('id'),'inactive');
                                        $(this).text('Activate');
                                        $(this).prev().text('status: inactive')
                                    }
                                });
                                let div_0 = $('<div class="container mb-2 cover"></div>');
                                let div_1 = $(' <h4>'+ res["result"][i]["role"] +'</h4>');
                                let div_2 = $('<div class="row m-1 align-items-center w-100"></div>');
                                let div_3 = $('<h4 class="border border-dark rounded p-1 col-md-2"><small>name: </small>'+ res["result"][i]["name"] +'</h4>');
                                let div_4 = $('<h4 class="ml-3 border border-dark rounded p-1 col-md-3"><small>email: </small>'+ res["result"][i]["email"] +'</h4>');
                                let div_5 = $('<h4 class="ml-3 border border-dark rounded p-1 "><small>added: </small>'+ res["result"][i]["created_at"] +'</h4>');
                                let div_6 = $('<h4 class="ml-3 border border-dark rounded p-1 col-md-2"><small>status: </small> '+ res["result"][i]["status"] +'</h4>');
                                div_0.append(div_1,div_2);
                                div_2.append(div_3,div_4,div_5,div_6,but);


                                $('#place').append(div_0);


                            }




                        },
                        error:function (res) {
                            console.log(res);
                        }

                    });
                }

            });
        })
    </script>





@stop

