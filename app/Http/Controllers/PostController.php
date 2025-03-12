<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostController extends Controller
{
    public function blog(){
        $latestPost = Post::orderBy('created_at', 'desc')->first();
        $posts = post::all();
        $data['meta_title'] = "All Blog pages";
		$data['meta_des'] = "All Blog pages";
        // dd($data);
        $viewData = array_merge(compact('latestPost', 'posts'), $data);
        return view('all-blogs', $viewData);
    }
    public function ViewBlog($slug){
        $page_data = post::first(['meta_title','meta_description']);
        $data['meta_title'] = $page_data->meta_title;
		$data['meta_des'] = $page_data->meta_description;
        $posts = Post::where('p_url', $slug)->first();
        return view('view-post',array_merge(compact('posts'),$data));

    }
}