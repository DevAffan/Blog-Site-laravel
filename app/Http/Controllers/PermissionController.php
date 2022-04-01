<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){

        $permissions = Permission::all();
        return view('admin.permissions.index' , compact('permissions'));
    }

    public function store(Request $request)
    {
        //
        // dd($request);

        $request->validate([
            'name' => ['required'],
        ]);
        $permmission = new Permission();
        $permmission->name = Str::ucfirst($request->name);
        $permmission->slug = Str::of(Str::lower($request->name))->slug('-');
        $permmission->save();
        return back();
    }

    public function edit($id)
    {
        dd($id);
    }

    public function destroy($id){
        $permission = Permission::find($id);
        $permission->delete();

        return back();
    }


}
