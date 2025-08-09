<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $blogposts = BlogPost::all();
        $categories = Category::all();
        // $categories = Category::withCount('blogposts')->get();
        return view('frontend.index', compact('blogposts'), compact('categories'));
    }
    public function categoryBlogs($id)
    {
        // Get the category with blogs
        $category = Category::where('id', $id)->firstOrFail();

        // Load blogs that belong to this category
        $blogposts = $category->blogs()->latest()->get();

        // Load all categories for the sidebar
        $categories = Category::withCount('blogs')->get();

        return view('frontend.index', compact('blogposts', 'categories', 'category'));
    }

    // public function show($id)
    // {
    //     $blogpost = BlogPost::findOrFail($id);
    //     return view('frontend.show', compact('blogpost'));
    // }
    public function show($slug)
    {
        $blogpost = BlogPost::where('slug', $slug)->firstOrFail();
        $approvedComments = $blogpost->comments()->where('is_active', true)->latest()->get();
        $latestBlogs = BlogPost::latest()->take(3)->get();
        $relatedBlogs = BlogPost::where('category_id', $blogpost->category_id)
            ->where('id', '!=', $blogpost->id)
            ->take(6)
            ->get();
        return view('frontend.show', compact('blogpost', 'approvedComments', 'latestBlogs', 'relatedBlogs'));
    }
}
