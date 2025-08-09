<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        // Logic to display permissions
        // $permissions = Permission::orderBy('created_at', 'desc')->paginate(10 );
        // return view('permission.List', compact('permissions'));
          $query = Permission::query();

    // Check if the request is AJAX and has a search term
    if ($request->ajax()) {
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $permissions = $query->orderBy('created_at', 'desc')->paginate(10);

        // Return just the table content section
        return response()->json([
            'html' => view('permission.table', compact('permissions'))->render()
        ]);
    }

    // Regular non-AJAX page load
    $permissions = $query->orderBy('created_at', 'desc')->paginate(10);
    return view('permission.list', compact('permissions'));
    }

    public function create()
    {
        // Logic to show form for creating a new permission
        return view('permission.createpermission');
    }

    public function store(Request $request)
    {
        // Logic to store a new permission
        // $request->validate([
        //     'name' => 'required|unique:permissions|max:255',
        // ]);

        // // Assuming Permission is a model for permissions
        // Permission::create($request->all());

        // return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');

        $validator =Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3|max:25',
        ]);
        if($validator ->passes()){
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }


    public function destroy($id)
    {
        // Logic to delete a permission
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
    public function edit($id)
    {
        // Logic to show form for editing a permission
        $permission = Permission::findOrFail($id);
        return view('permission.edit', compact('permission'));
    }
    public function update(Request $request, $id){
        $validator =Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3|max:25' .$id,
        ]);
        if($validator ->passes()){
             $permission = Permission::findOrFail($id);
             $permission->update(['name' => $request->name]);
             // Assuming you want to redirect to the permissions index after updating
            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
  
}
