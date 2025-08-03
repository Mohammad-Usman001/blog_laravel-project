<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(){
        $likes= Like::with('post')->latest()->get();
        return view('likes.index', compact('likes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:blogposts,id',
        ]);
        $ip = $request->ip();
        $post_id = $request->post_id;

        // Prevent duplicate like from same IP
        $alreadyLiked = Like::where('post_id', $post_id)
            ->where('guest_ip', $ip)
            ->exists();

        if ($alreadyLiked) {
            return response()->json([
                'status' => 'duplicate',
                'message' => 'You already liked this post.'
            ], 409);
        }

        // Create like
        Like::create([
            'post_id' => $post_id,
            'guest_ip' => $ip,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Liked successfully.'
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:blogposts,id',
        ]);

        $ip = $request->ip();
        $post_id = $request->post_id;

        $like = Like::where('post_id', $post_id)
            ->where('guest_ip', $ip)
            ->first();

        if ($like) {
            $like->delete();

            return response()->json([
                'status' => 'disliked',
                'message' => 'You removed your like.',
            ]);
        }

        return response()->json([
            'status' => 'not_found',
            'message' => 'No like found to remove.',
        ], 404);
    }
}
