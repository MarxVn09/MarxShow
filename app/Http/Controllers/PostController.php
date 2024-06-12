<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('site.post.index',compact('posts'));
    }
    public function byView()
    {
        $posts = DB::table('posts')->select('*')->orderBy('view','desc')->limit(8)->get();
        return view('site.post.index',compact('posts'));
    }
    public function new()
    {
        $posts = DB::table('posts')->select('*')->orderBy('created_at','desc')->limit(8)->get();
        return view('site.post.index',compact('posts'));
    }
    public function byCat($id)
    {
        $name_cat= 'Category'.' '.$id;
        $posts = DB::table('posts')->select('*')->where('id_category_post','=',$id)->orderBy('created_at','desc')->limit(8)->get();
        return view('site.post.index',compact('posts','name_cat'));
    }
    public function detail($id)
    {
        $i = Post::find($id);
        return view('site.post.detail',compact('i'));
    }
}
