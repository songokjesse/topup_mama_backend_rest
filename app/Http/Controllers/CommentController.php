<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function  index(){
        $comments = DB::table('comments')
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($comments);
    }

    public function show($id){
        $comment = Comment::find($id);
        return response()->json($comment);
    }

    public function create(Request $request){
        $this->validate($request, [
            'comment' => 'required|max:500',
            'book_id' => 'required',
        ]);

        $comment = new Comment();
        $comment->comment =  $request->input('comment');
        $comment->book_id = $request->input('book_id');
        $comment->ip_address = $request->ip();
        $comment->save();

        return response()->json($comment);
    }
    public function store(){
    }

    //
}
