<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        $categories = Category::take(10)->get()->pluck('name','id');
        return view('customer_views.login',['categories' => $categories]);
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json(['success' => 'User has been logged in successfully']);
        }

        return response()->json(['error' => 'Wrong email address or password']);
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return response()->json(['success' => 'User has been registered successfully']);
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    } 
}
