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
        // dd($posts);
        return view('view-post',compact('latestPost','posts'));

    }
}