<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use App\Models\Permission;

class PermissionController extends Controller
{
    //
public function index(){

    return view('admin.permissions.index',[
        'permissions'=> Permission::all(),



    ]);
}
public function edit(Permission $permission){

    return view('admin.permissions.edit', [
        'permission'=>$permission,
        'roles'=> Role::all()
        ]);

}

public function store(){
    request()->validate([
        'name'=> ['required']

    ]);
    Permission::create([
        'name'=> Str::ucfirst(request('name')),
        'slug'=> Str::of(Str::lower(request('name')))->slug('-')

    ]);
        return back();
}

public function update(Permission $permission){

    $permission->name = Str::ucfirst(request('name'));
    $permission->slug = Str::of(request('name'))->slug('-');
    if($permission->isDirty('name')){
        session()->flash('permission-updated', 'Permission updated to : '. request('name'));
        $permission->save();
    }else{
        session()->flash('permission-updated', 'Nothing has been updated ');
}
    return back();
}
 public function attachRole(Permission $permission){

    $permission->roles()->attach(request('role'));
    return back();

 }
 public function detachRole(Permission $permission){

    $permission->roles()->detach(request('role'));
    return back();

 }

 public function destroy(Permission $permission){

    $permission->delete();

    session()->flash('permission-deleted', 'Deleted permission '. $permission->name);

    return back();

}

}
