<?php

namespace App\Http\Controllers\Web\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'commentable_id' => 'required|exists:posts,id'
        ]);


        $validator->validate();

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = 'App\Models\Post';
        $comment->content = $request->message;
        $comment->rate = $request->rating;
        $comment->active = 0;
        $comment->save();

        flash(t('Your comment successfully insert'))->success();
        return redirect()->back();
    }
}
