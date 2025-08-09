<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view Categories', only: ['index']),
            new Middleware('permission:create Categories', only: ['create']),
            new Middleware('permission:edit Categories', only: ['edit']),
            new Middleware('permission:delete Categories', only: ['delete']),
            
        ];
    }
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->passes()) {
            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->passes()) {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->destroy($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
