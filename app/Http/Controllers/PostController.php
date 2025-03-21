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
    public function deletePost($id){
        // dd($id);
        $page_data = post::first(['meta_title','meta_description']);
        $data['meta_title'] = $page_data->meta_title;
		$data['meta_des'] = $page_data->meta_description;
        $posts = Post::where('id', $id)->first();
        $posts = $posts->delete();
        return redirect('/allpost');

    }
    public function editPost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect('/allpost')->with('error', 'Post not found.');
        }

        return view('Dashboard.edit-post',compact('post')); 
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect('/allpost')->with('error', 'Post not found.');
        }

        $request->validate([
            'p_title' => 'required|string|max:255',
            'p_url' => 'required|string|',
            'short_des' => 'required|string|max:255',
            'p_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'p_description' => 'required',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
        ]);
        // $imagePath = null;
        // if ($request->hasFile('p_image')) {
        //     $image = $request->file('p_image');
        //     $img_name = time() . '_' . $image->getClientOriginalName();
        //     $destinationPath = public_path('posts'); 
        //     $image->move($destinationPath, $img_name);
        //     $imagePath = 'posts/' . $img_name;
        // }

        $post->update($request->all()); 
        // dd($post);
        // return view('/edit-post',compact('post'));
        return redirect('/allpost',)->with('success', 'Post updated successfully.');
    }

}