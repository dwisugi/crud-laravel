<?php

namespace App\Http\Controllers\ajaxcrud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Redirect,Response;

class AjaxPostController extends Controller
{
    public function index(){
        $data['posts'] = Post::orderBy('id','desc')->paginate(8);
        return view('index',$data);
    }
    public function store(Request $request){
        $postID = $request->post_id;
        $post = Post::updateOrCreate(['id'=>$postID],
        ['title'=>$request->title, 'body' => $request->body]);
        return Response::json($post);
    }
    public function edit($id){
        $where = array('id'=>$id);
        $post = Post::where($where)->first();
        return Response::json($post);
    }
    public function destroy($id){
        $post = Post::where('id',$id)->delete();
        return Response::json($post);
    }
}
