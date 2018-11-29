<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect('/post');
    }
}
