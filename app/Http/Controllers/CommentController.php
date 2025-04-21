<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            // Admin sees all comments
            $comments = Comment::with('post', 'user')->latest()->paginate(10);
        } else {
            // Regular users see only their comments
            $comments = Comment::with('post', 'user')
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        }

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id,
            'content' => $request->content,
            'status' => 'spam',
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully. It will be reviewed by an admin before being published.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'approved';
        $comment->save();

        return back()->with('success', 'Comment approved.');
    }

    public function spam($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'spam';
        $comment->save();

        return back()->with('success', 'Comment marked as spam.');
    }
}
