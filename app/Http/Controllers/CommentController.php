<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        // Show all unapproved and approved comments to admin
        $comments = Comment::with('post')->latest()->paginate(15);
        return view('comments.index', compact('comments'));
    }
    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_active = true;
        $comment->save();

        return redirect()->back()->with('message', 'Comment approved successfully.');
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect()->back()->with('message', 'Comment deleted.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:blogposts,id',
            'guest_name' => 'required|string|min:3|max:30',
            'guest_email' => 'nullable|email',
            'comment' => 'required|string|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the comment (inactive by default)
        Comment::create([
            'post_id'     => $request->post_id,
            'guest_name'  => $request->guest_name,
            'guest_email' => $request->guest_email,
            'comment'     => $request->comment,
            'is_active'   => false, // Admin must approve
        ]);
        return redirect()->back()->with('message', 'Your comment has been submitted and is awaiting approval.');
    }

    public function bulkDelete(Request $request)
    {
        $blogIds = $request->input('selected_blogs');

        if ($blogIds) {
            Comment::whereIn('id', $blogIds)->delete();
            return redirect()->route('comments.index')->with('success', 'Selected blogs have been deleted.');
        }

        return redirect()->route('comments.index')->with('error', 'No blogs selected for deletion.');
    }

   

 
}
