<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
      $users = User::get();
      return view('indexUser', compact('users'));
    }




    public function editUser($id)
    {
      $user=User::findOrFail($id);
      $roles=Role::get()->pluck('name')->toArray();
      return view('editUser', compact('user','roles'));

    }


    public function updateUser(Request $request, $id)
    {
      $validatedData = $request->validate([
       'name' => 'required|max:255',

   ]);
      $data = $request->all();

      $user = User::find($id);
      $roles=[];
      if(isset($data['roles'])){
        $roles=$data['roles'];
      }
      if(!isset($data['password'])){
        unset($data['password']);
      }
      else {
        $data['password']=Hash::make($data['password']);
      }
      $user->syncRoles($roles);
      $user->update($data);
      return redirect('/users')->with('success', 'User is successfully edited');
    }

    public function deleteUser($id)
    {
      $user = User::findOrFail($id);
      $user->delete();
      return redirect('/users')->with('success', 'User is successfully deleted');
    }

    public function createUser(){
      return view('createUser');
    }

    protected function storeUser(Request $request)
    {
      $data = $request->all();
      $user = User::create([
       'name' => $data['name'],
       'email' => $data['email'],
       'password' => Hash::make($data['password']),
        ]);
      $roles=[];
      if(isset($data['roles'])){
        $roles=$data['roles'];
      }
      $user->syncRoles($roles);
      return redirect('/users')->with('success', 'User is successfully created');

    }
}
