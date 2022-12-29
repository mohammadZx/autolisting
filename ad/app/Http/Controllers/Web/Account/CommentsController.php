<?php

namespace App\Http\Controllers\Web\Account;


use App\Models\Comment;
use Illuminate\Http\Request;
use Larapen\LaravelMetaTags\Facades\MetaTag;

class CommentsController extends AccountBaseController
{
    public function index(){
        MetaTag::set('title', t('Comments'));
		MetaTag::set('description', t('Comments', ['appName' => config('settings.app.name')]));

        $user = auth()->user();
        $results = Comment::whereActive(1)->whereParentId(0)->whereHas('commentable' , function($q) use($user){
            $q->whereUserId($user->id);
        })->with(['commentable', 'user'])->paginate(50);

        return appView('account.comments.index', ['results' => $results]);

    }
    public function answer(Request $request){
        $request->validate([
            'comment_parent' => 'required|exists:comments,id',
            'content' => 'required'
        ]);
        $parentComment = Comment::findOrFail($request->comment_parent);

        $comment = new Comment();
        $comment->commentable_id = $parentComment->commentable_id;
        $comment->commentable_type = $parentComment->commentable_type;
        $comment->active = 0;
        $comment->rate = 0;
        $comment->content = $request->content;
        $comment->parent_id = $request->comment_parent;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        // Notification Message
	
		flash(t('Your comment successfully insert'))->success();
        return redirect()->back();
    }
}
