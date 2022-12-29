@foreach($comments as $comment)
@if($comment->active)
<div class="comment mt-2 @if($comment->parent_id != 0) comment-children @endif">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <p><strong>{{$comment->user->name}} @if(isset($is_owner) && $is_owner) {!! getPostUrl($comment->commentable) !!} @endif</strong>
            <span class="float-right">
              @if($comment->rate)
              @for($i=1; $i <= $comment->rate; $i++)
              <i class="text-warning fa fa-star"></i>
              @endfor
              @endif
            </span>
          </p>
          <div class="clearfix"></div>
          <p>{{$comment->content}}</p>
          @if(isset($is_owner) && $is_owner)
          <label for="answer-toggle-{{$comment->id}}" class="btn btn-sm btn-primary">پاسخ</label>
          <input type="checkbox"  id="answer-toggle-{{$comment->id}}" class="d-none answer-toggle">
          <form class="answer-form mt-2 d-none"  action="{{route('account_comment_answer')}}" method="post">
            @csrf
            <input type="hidden" name="comment_parent" value="{{$comment->id}}">
            <textarea required name="content" placeholder="{{t('Comment answer')}}" cols="30" rows="10" class="form-control"></textarea>
            <button class="btn btn-warning btn-sm mt-2">ارسال</button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
  @if($comment->childrens)
  @include('vendor.comment.comment', ['commentable' => $commentable, 'comments' => $comment->childrens])
  @endif
</div>
@endif
@endforeach