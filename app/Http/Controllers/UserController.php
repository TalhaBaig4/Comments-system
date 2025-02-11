<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{

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

        return redirect('/login')->with('success', 'Registration successful!'); 
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
        // $pass = bcrypt($request->input('password'));
        $credentials = $request->only('email', 'password'); 
        // dd($credentials);

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard'); 
        }

        return redirect('/login') 
            ->withErrors(['email' => 'These credentials do not match our records.']) // Custom error message
            ->withInput(); 

    }

    public function DashboardUser(){
        // $user = Auth::user(); 
        // dd($user);
        // dd('dashboard');
        if(Auth::check()){
            return view('Dashboard.DashboardUser'); 
        }else{

            return view('/'); 
        }

        // return redirect('/login') // Or back()
        //         ->withErrors('lsdjf');
    }


}
