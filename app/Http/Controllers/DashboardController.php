<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller 
{

    public function index(){
        $BlogpostCount = BlogPost::count();
        $blogPostCountToday = BlogPost::whereDate('created_at', Carbon::today())->count();
        $categoryCount =Category::count();
        $commentCount = Comment::count();
        $pendingCommentCount = Comment::where('is_active', false)->count();
        $likeCount =Like::count();

        return view('admin.dashboard', compact('BlogpostCount','categoryCount','commentCount','likeCount','blogPostCountToday','pendingCommentCount'));
    }
}
