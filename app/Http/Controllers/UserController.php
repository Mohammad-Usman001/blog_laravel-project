<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:create users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit']),
            new Middleware('permission:delete users', only: ['delete']),
            
        ];
    }

    public function index()
    {
        // Logic to retrieve and return a list of users
        $users =User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function create(){
        // Logic to show a form for creating a new user
        $roles = Role::orderBy('name', 'asc')->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Logic to store a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);
        
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
    public function edit($id){
        // Logic to show a form for editing an existing user
        $users = User::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->get();
        $hasRoles= $users->roles->pluck('id');
        return view('users.edit', compact('users' , 'roles', 'hasRoles'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);
        // Logic to update an existing user
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
    public function destroy($id)
    {
        // Logic to delete a user
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
