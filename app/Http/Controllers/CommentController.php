<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        //return view('index', compact('comments'));
        return $comments;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'comment' => 'required',
        ]);

        Comment::create($request->all());

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        
        if ($comment) {
            $comment->delete();
        }

        return redirect()->route('comments.index');
    }
}
