<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function postValidate($request){
        $request->validate([
            'title'=>'required|string|min:5|max:50',
            'subtitle'=>'required|string|min:10|max:100',
            'text'=>'required|string|min:10|max:2000',
            'image'=>'required|image|mimes:jpg,jpeg,png|max:10000'
        ]);
    }
    public function post(){
        return view('admin.add_post');
    }
    public function add_post(Request $request){

        $this->postValidate($request);
        $file = $request->image;
        $fileName = Str::random(20).$file->getClientOriginalName();
        $file->move(public_path('postImage'),$fileName);
        Post::create([
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'text'=>$request->text,
            'image'=>$fileName
        ]);

        return back();
    }

    public function all_posts($id = null){
        if($id === null)
            $i = 0;
        $id*=5;
        $product = Post::orderBy('id','desc')->skip($id)->limit(5)->get();
        if (!$id)
            return view('admin.posts',['posts'=>$product]);
        return Response::json(array('success'=>true,'result'=>$product));
    }

    public function all_users($id = null){
        if($id === null)
            $id = 0;
        $id*=20;
        $product = User::orderBy('id','desc')->skip($id)->limit(20)->get();
        if (!$id)
            return view('admin.users',['users'=>$product]);
        return Response::json(array('success'=>true,'result'=>$product));
    }

    public function delete_post($id){
        Post::where('id',$id)->delete();
        return back();
    }
    public function edit_post($id){
        $posts = Post::where('id',$id)->get();
        return view('admin.edit_post',['posts'=>$posts]);
    }

    public function update_post(Request $request){
        if($request->image){
            $file = $request->image;
            $fileName = Str::random(20).$file->getClientOriginalExtension();
            $file->move(public_path('postImage'),$fileName);
            Post::where('id',$request->id)->update([
                'image'=>$fileName
            ]);
        }
        Post::where('id',$request->id)->update([
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'text'=>$request->text,
        ]);

        return redirect('admin/posts');

    }
    public function set_status(Request $request,$id){
        if($request->status === 'active'){
            User::where('id',$id)->update([
                "status"=>'active'
            ]);
        }
        else{
            User::where('id',$id)->update([
                "status"=>'inactive'
            ]);
        }
        return Response::json(['success'=>$id]);
    }

}
