
@extends('layouts.master')


@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<div class="main-container">
		<div class="container">
			<div class="row">

				@if (session()->has('flash_notification'))
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								@include('flash::message')
							</div>
						</div>
					</div>
				@endif

				<div class="col-md-3 page-sidebar">
					@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
				</div>

				<div class="col-md-9 page-content">
					<div class="inner-box">
						<h2 class="title-2"><i class="fas fa-bell"></i> {{ t('Comments') }} </h2>
						<div class="row">
							<div class="col-md-12">
							
								@include('vendor.comment.comment', ['commentable' => null, 'comments' => $results , 'is_owner' => true])
								
								<div style="clear:both;"></div>
								
								<div class="pagination-bar text-center">
									{{$results->links()}}
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection

