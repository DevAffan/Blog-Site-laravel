<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //


    public function index(){
        $users = User::all();
        return view('admin.users.index' , compact('users'));
    }

    public function show(User $user){
        return view('admin.users.profile' , ['user' => $user]);
    }


    public function update(Request $request){

        $input = request()->validate([
            'user_name' => ['required', 'string', 'max:255' , 'unique:users', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file'],
        ]);
        // dd($request);
        // dd($request->avatar);

        $user = User::find(auth()->user()->id);

        if ($request->file('avatar')) {
            # code...
            $input['avatar'] = $request->file('avatar')->store('public/images');
            $user->avatar = $input['avatar'];
        }



        // dd($user);
        $user->user_name = $input['user_name'];
        $user->name = $input['name'];
        $user->email = $input['email'];

        $user->save();

        return back();

    }

    public function edit($user2){

        $user = User::findorfail($user2);
        // dd($user2);
        $roles = Role::all();
        return view('admin.users.profile' , compact('user' , 'roles'));
    }

    public function attach(Request $request ,User $user){
        $user->roles()->attach($request->role);
        return back();
    }

    public function detach(Request $request ,User $user){
        $user->roles()->detach($request->role);
        return back();
    }


    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
