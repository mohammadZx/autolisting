@foreach($comments as $comment)
@if($comment->active)
<div class="comment mt-2">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <p><strong>{{$comment->user->name}}</strong>
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