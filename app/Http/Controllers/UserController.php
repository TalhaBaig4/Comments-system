<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class UserController extends Controller
{
    public function signup(){
        return view('/register'); 
    }
    public function signin(){
        return view('/login'); 
    }

    public function Register(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required' 
        ]);

        if ($data->fails()) {
            return redirect('/register')
                ->withErrors($data)->withInput();
        }
        $data = $data->validated();
        $data['password'] = bcrypt($data['password']);
        // dd($data);
        $user = User::create($data);
        if($user){
            return redirect('/login')->with('success', 'Registration successful!'); 
        }else{
            return redirect('/register')->with('error', 'Registration Not successfully ocars!'); 
        }
        // or you can use for save data in db

        // $user = new User();
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $user->password = bcrypt($request->input('password'));
        // $user->save();
    }

    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/login') // Or back()
                ->withErrors($validator)
                ->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {    
            return redirect('/dashboard');
        }

        return redirect('/login') 
            ->withErrors(['email' => 'These credentials do not match our records.'])
            ->withInput(); 

    }

    public function DashboardUser(){
        if(Auth::check()){
            return view('Dashboard.DashboardUser'); 
        }else{
            return view('/'); 
        }
    }


    public function logout(){
        Auth::logout();
        return view('/login');
    }


    public function showAddPostForm()
    {
        if(Auth::check()){
            return view('dashboard.AddPost');
        }else{
            return view('/');
            
        }
    }

    public function add_posts(Request $request){
        $user = Auth::user();
        // dd('sdf');

        if(Auth::check()){
            // dd($user);
            // if($request){
                $request->validate([
                    'p_title' => 'required|string|max:255',
                    'p_url' => 'required|string|unique:posts,p_url',
                    'short_des' => 'required|string|max:255',
                    'p_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                    'p_description' => 'required',
                    'meta_title' => 'required|string|max:255',
                    'meta_description' => 'required|string',
                ]);
                // dd($request);
                // Handle Image Upload
                $imagePath = null;
                if ($request->hasFile('p_image')) {
                    $image = $request->file('p_image');
                    $img_name = time() . '_' . $image->getClientOriginalName();
                    $destinationPath = public_path('posts'); 
                    $image->move($destinationPath, $img_name);
                    $imagePath = 'posts/' . $img_name;
                }
                // Create Post
                Post::create([
                    'user_id' => Auth::id(),
                    'p_title' => $request->p_title,
                    'p_url' => $request->p_url,
                    'short_des' => $request->short_des,
                    'p_image' => $imagePath,
                    'p_description' => $request->p_description,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                ]);
        
                return redirect()->route('Dashboard.AddPost')->with('success', 'Post created successfully!');
            // }else{
            //     return redirect()->route('Dashboard.AddPost');                
            // }
            // return redirect('addpost');                
        }else{

            return redirect('/'); 
        }
    }   

    public function allpost()
    {  
        if(Auth::check()){
            $posts = post::get();
            // dd($posts);
            return view('dashboard.allposts', compact('posts'));

        }else{
            return view('/');
        }
    }


}
