<form class="form-comment mb-3" action="{{route('comment.store')}}" method="POST">
  @csrf
  <input type="hidden" name="commentable_id" value="{{data_get($commentable, 'id')}}">
		<div class="row">
			<div class="col-12">
        <ul class="rate-area">
          <input type="radio" id="5-star" name="rating" value="5" /><label for="5-star" title="Amazing">5 stars</label>
          <input type="radio" id="4-star" name="rating" value="4" /><label for="4-star" title="Good">4 stars</label>
          <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average">3 stars</label>
          <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good">2 stars</label>
          <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad">1 star</label>
        </ul>
			</div>
			<div class="col-12">									
				<div class="form-group">
					<textarea class="form-control" name="message" required placeholder="{{t('Your comment')}}"></textarea>
				</div>
			</div>
      <div class="col-md-3 mt-2">
        @if(auth()->check())
        <button class="btn btn-primary" id="sendcomment">{{t('Send comment')}}</button>
        @else
        <a href="#forcelogin" class="btn btn-primary submit-form login-button" data-callback="submitComment" data-redirect="false" data-close="true" data-bs-toggle="modal">{{t('Send comment')}}</a>
        @endif
      </div>
		</div>
	</form>