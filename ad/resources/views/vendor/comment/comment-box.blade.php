<div class="comment-box">
    <h3 class="title-comment">{{t('Comments')}}</h3>
    @include('vendor.comment.comment-form', ['commentable' => $commentable])

    <div class="comments">
        @include('vendor.comment.comment', ['commentable' => $commentable])
    </div>
</div>