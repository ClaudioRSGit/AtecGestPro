<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id'
        ]);

        $comment = new Comment();
        $comment->description = $request->comment;
        $comment->ticket_id = $request->ticket_id;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('tickets.show', $comment->ticket_id)->with('success', 'Comentário adicionado com sucesso.');
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
