<?php

namespace App\Http\Controllers;

use App\Post;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class MainController extends Controller
{


    public function start($id = null){
        if($id === null)
            $id = 0;
        $id*=9;
        $product = Post::orderBy('id','desc')->skip($id)->limit(9)->get();
        if (!$id)
            return view('welcome',['posts'=>$product]);
        return Response::json(array('success'=>true,'result'=>$product));
    }
    public function redir(){
        return redirect("/welcome");
    }

    public function post_page($id){
        $product = Post::where('id',$id)->get();
        return view('post',['posts'=>$product]);
    }
}
