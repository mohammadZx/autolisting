
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

				<div class="col-md-9 page-content requests">
					<div class="inner-box">
						<h2 class="title-2"><i class="fas fa-bell"></i> {{ t('Lastest Requests') }} </h2>
						<p>{{t('You can call the users that send a requests')}}</p>
						<div class="row">
							<div class="col-md-12 p-3 p-md-3">

                                @foreach($results as $request)
                                    <div class="row request-item bg-white rounded mt-4 border border-secondary">
                                        <div class="col-md-3 name mt-2"><strong>{{t('Name')}}: </strong>{{$request->name}}</div>
                                        <div class="col-md-3 phone mt-2"><strong>{{t('phone')}}: </strong>{{$request->phone}}</div>
                                        <div class="col-md-3 city mt-2"><strong>{{t('city')}}: </strong>{{$request->city}}</div>
                                        <div class="col-md-3 car-model mt-2"><strong>{{t('Car model')}}: </strong>{{$request->car_model}}</div>
                                        @if($request->image)
                                        <div class="col-md-3 image mt-2">
                                            <img class="rounded" src="{{imgUrl($request->image)}}" alt="">
                                            <strong>{{t('date')}}: {{jdate('Y/m/d H:i:s', strtotime($request->created_at))}}</strong>
                                        </div>
                                        <div class="col-md-9 content mt-2"><strong>{{t('content')}}: </strong>{{$request->content}}</div>
                                        @else
                                        <div class="col-md-12 content mt-2"><strong>{{t('content')}}: </strong>{{$request->content}} <br> <strong>{{t('date')}}: {{jdate('Y/m/d H:i:s', strtotime($request->created_at))}}</strong></div>
                                        @endif
                                    </div>
                                @endforeach

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

