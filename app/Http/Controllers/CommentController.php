<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use App\Events\NewComment;
use Debugbar;
use Log;
use Bugsnag;

class CommentController extends Controller
{
    //
    public function index(Post $post)
    {

        $comments = $post->comments()
        ->with('user')
        ->latest()
        ->get();
        return response()->json($comments);
    }

    public function save(Request $request, Post $post)
    {
        $comment = null;
        if($request->body){
            $comment = $post->comments()->create([
                'body'    => $request->body,
                'user_id' => Auth::id(),
            ]);

        $comment = Comment::where('id',$comment->id)
                          ->with('user')
                          ->first();
        }
        if($comment){
            broadcast(new NewComment($comment))->toOthers();
        }
        return $comment ? $comment->toJson() : '';
    }
}
