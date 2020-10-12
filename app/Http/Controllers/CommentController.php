<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use App\Events\NewComment;
use Debugbar;

class CommentController extends Controller
{
    //
    public function index(Post $post)
    {
        return response()->json($post->comments()
                                     ->with('user')
                                     ->latest()
                                     ->get()
                                    );
    }

    public function save(Request $request, Post $post)
    {
        $comment = $post->comments()->create([
            'body'    => $request->body,
            'user_id' => Auth::id(),
        ]);
        $comment = Comment::where('id',$comment->id)
                          ->with('user')
                          ->first();

        broadcast(new NewComment($comment))->toOthers();

        return $comment->toJson();
    }
}
