{{--
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
--}}
@extends('layouts.master')

@section('wizard')
	@includeFirst([config('larapen.core.customizedViewPath') . 'post.createOrEdit.multiSteps.inc.wizard', 'post.createOrEdit.multiSteps.inc.wizard'])
@endsection

<?php
// Category
if ($post->category) {
    if (empty($post->category->parent_id)) {
        $postCatParentId = $post->category->id;
    } else {
	    $postCatParentId = $post->category->parent_id;
	}
} else {
	$postCatParentId = 0;
}
?>
@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<div class="main-container">
		<div class="container">
			<div class="row">
				
				@includeFirst([config('larapen.core.customizedViewPath') . 'post.inc.notification', 'post.inc.notification'])

				<div class="col-md-9 page-content">
					<div class="inner-box category-content" style="overflow: visible;">
						<h2 class="title-2">
							<strong><i class="fas fa-edit"></i> {{ t('update_my_listing') }}</strong>
							-&nbsp;<a href="{{ \App\Helpers\UrlGen::post($post) }}"
							   class="" data-bs-placement="top"
								data-bs-toggle="tooltip"
								title="{!! $post->title !!}"
							>{!! str($post->title)->limit(45) !!}</a>
						</h2>
						
						<div class="row">
							<div class="col-12">
								
								<form class="form-horizontal" id="postForm" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<input name="_method" type="hidden" value="PUT">
									<input type="hidden" name="post_id" value="{{ $post->id }}">
									<fieldset>
										
										{{-- category_id --}}
										<?php $categoryIdError = (isset($errors) && $errors->has('category_id')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $categoryIdError }}">{{ t('category') }} <sup>*</sup></label>
											<div class="col-md-12">
												<div id="catsContainer" class="rounded{{ $categoryIdError }}">
													<a href="#browseCategories" data-bs-toggle="modal" class="cat-link" data-id="0">
														{{ t('select_a_category') }}
													</a>
												</div>
											</div>
											<input type="hidden" name="category_id" id="categoryId" value="{{ old('category_id', $post->category->id) }}">
											<input type="hidden" name="category_type" id="categoryType" value="{{ old('category_type', $post->category->type) }}">
										</div>
										
										@if (config('settings.single.show_listing_types'))
											{{-- post_type_id --}}
											@if (isset($postTypes))
												<?php $postTypeIdError = (isset($errors) && $errors->has('post_type_id')) ? ' is-invalid' : ''; ?>
												<div id="postTypeBloc" class="row mb-3 required">
													<label class="col-md-12 text-start col-form-label{{ $postTypeIdError }}">{{ t('type') }} <sup>*</sup></label>
													<div class="col-md-12">
														@foreach ($postTypes as $postType)
															<div class="form-check form-check-inline">
																<input name="post_type_id"
																	id="postTypeId-{{ $postType->id }}" value="{{ $postType->id }}"
																	type="radio"
																	class="form-check-input{{ $postTypeIdError }}"
																	{{ (old('post_type_id', $post->post_type_id)==$postType->id) ? ' checked="checked"' : '' }}
																>
																<label class="form-check-label mb-0" for="postTypeId-{{ $postType->id }}">
																	{{ $postType->name }}
																</label>
															</div>
														@endforeach
														<div class="form-text text-muted">{{ t('post_type_hint') }}</div>
													</div>
												</div>
											@endif
										@endif

										{{-- title --}}
										<?php $titleError = (isset($errors) && $errors->has('title')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $titleError }}" for="title">{{ t('title') }} <sup>*</sup></label>
											<div class="col-md-12">
												<input id="title" name="title" placeholder="{{ t('listing_title') }}" class="form-control input-md{{ $titleError }}"
													   type="text" value="{{ old('title', $post->title) }}">
												<div class="form-text text-muted">{{ t('a_great_title_needs_at_least_60_characters') }}</div>
											</div>
										</div>

										{{-- description --}}
										<?php $descriptionError = (isset($errors) && $errors->has('description')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<?php
												$descriptionErrorLabel = '';
												$descriptionColClass = 'col-md-8';
												if (config('settings.single.wysiwyg_editor') != 'none') {
													$descriptionColClass = 'col-md-12';
													$descriptionErrorLabel = $descriptionError;
												} else {
													$post->description = strip_tags($post->description);
												}
											?>
											<label class="col-md-12 text-start col-form-label{{ $descriptionErrorLabel }}" for="description">
												{{ t('Description') }} <sup>*</sup>
											</label>
											<div class="{{ $descriptionColClass }}">
												<textarea
														class="form-control{{ $descriptionError }}"
														id="description"
														name="description"
														rows="15"
														style="height: 300px"
												>{{ old('description', $post->description) }}</textarea>
												<div class="form-text text-muted">{{ t('describe_what_makes_your_listing_unique') }}</div>
                                            </div>
										</div>
										
										{{-- cfContainer --}}
										<div id="cfContainer"></div>

										@if(config('settings.show_price', false))
										{{-- price --}}
										<?php $priceError = (isset($errors) && $errors->has('price')) ? ' is-invalid' : ''; ?>
										<div id="priceBloc" class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $priceError }}" for="price">{{ t('price') }}</label>
											<div class="col-md-12">
												<div class="input-group">
													<span class="input-group-text">{!! config('currency')['symbol'] !!}</span>
													<?php
													$price = \App\Helpers\Number::format(old('price', $post->price), 2, '.', '');
													?>
													<input id="price"
														   name="price"
														   class="form-control{{ $priceError }}"
														   placeholder="{{ t('ei_price') }}"
														   type="number"
														   min="0"
														   step="{{ getInputNumberStep((int)config('currency.decimal_places', 2)) }}"
														   value="{!! $price !!}"
													>
													<span class="input-group-text">
														<input id="negotiable" name="negotiable" type="checkbox"
															   value="1" {{ (old('negotiable', $post->negotiable)=='1') ? 'checked="checked"' : '' }}>
														&nbsp;<small>{{ t('negotiable') }}</small>
													</span>
												</div>
												<div class="form-text text-muted">{{ t('price_hint') }}</div>
											</div>
										</div>
										@endif
										
										{{-- country_code --}}
										<input id="countryCode" name="country_code"
											   type="hidden"
											   value="{{ !empty($post->country_code) ? $post->country_code : config('country.code') }}"
										>
									
										@if (config('country.admin_field_active') == 1 && in_array(config('country.admin_type'), ['1', '2']))
											{{-- admin_code --}}
											<?php $adminCodeError = (isset($errors) && $errors->has('admin_code')) ? ' is-invalid' : ''; ?>
											<div id="locationBox" class="row mb-3 required">
												<label class="col-md-12 text-start col-form-label{{ $adminCodeError }}" for="admin_code">
													{{ t('location') }} <sup>*</sup>
												</label>
												<div class="col-md-12">
													<select id="adminCode" name="admin_code" class="form-control large-data-selecter{{ $adminCodeError }}">
														<option value="0" {{ (!old('admin_code') || old('admin_code')==0) ? 'selected="selected"' : '' }}>
															{{ t('select_your_location') }}
														</option>
													</select>
												</div>
											</div>
										@endif


										{{-- province --}}
										<?php $provinceError = (isset($errors) && $errors->has('province_id')) ? ' is-invalid' : ''; ?>
										<div id="provinceBox" class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $provinceError }}" for="province_id">{{ t('province') }} <sup>*</sup></label>
											<div class="col-md-12">
												<select id="province_id" value="{{$post->city->subAdmin1->code}}" name="province_id" class="form-control large-data-selecter{{ $provinceError }}">
													<option value="0" {{ (!old('province_id' , $post->city->subAdmin1->code) || old('province_id', $post->city->subAdmin1->code)==0) ? 'selected="selected"' : '' }}>
														{{ t('select_a_province') }}
													</option>
													@foreach($provinces as $province)
													<option value="{{$province->code}}" {{ (old('province_id', $post->city->subAdmin1->code) == $province->id) ? 'selected="selected"' : '' }}>{{$province->name}}</option>
													@endforeach
												</select>
											</div>
										</div>

					
										{{-- part city_s2 --}}
										<?php $cityIdError = (isset($errors) && $errors->has('city_id')) ? ' is-invalid' : ''; ?>
										<div id="cityBox" class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $cityIdError }}" for="city_id">
												{{ t('part') }} <sup>*</sup>
											</label>
											<div class="col-md-12">
												<select id="cityS2Id" data-value="{{old('city_id', $post->city->id)}}" value="{{$post->city->id}}" name="city_id" class="form-control large-data-selecter{{ $cityIdError }}">
													<option value="0">
														{{ t('select_a_part') }}
													</option>
													<option selected="selected" value="{{$post->city->id}}" data-lat="" data-lon="">{{$post->city->name}}</option>
												</select>
											</div>
										</div>


										{{-- address  --}}
										<?php $addressError = (isset($errors) && $errors->has('address')) ? ' is-invalid' : ''; ?>
										<div id="address_box" class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $addressError }}" for="address">{{ t('address') }} <sup>*</sup></label>
											<div class="col-md-12">
											<input placeholder="{{ t('type address completely') }}" id="address" name="address"
												class="form-control input-md{{ $addressError }}"
												type="text"
												value="{{ old('address', $post->address) }}">
											</div>
										</div>

										{{-- map  --}}
										<?php
										$lat = (isset($errors) && $errors->has('latitude')) ? ' is-invalid' : '';
										$lon = (isset($errors) && $errors->has('longitude')) ? ' is-invalid' : '';
										?>
										<div id="map-box" class="row mb-3 required {{$lat }} {{$lon}}">
											<div class="col-md-12">
												<input type="hidden" name="latitude" value="{{ old('latitude', $post->lat) }}"  id="latitude">                  
												<input type="hidden" name="longitude" value="{{ old('longitude', $post->lon) }}" id="longitude" >
												<div id="utf_single_listingmap" data-lat="{{ old('latitude', $post->lat) }}" data-lon="{{ old('longitude', $post->lon) }}"></div>
											</div>
										</div>
										
										{{-- is_permanent --}}
										@if (config('settings.single.permanent_listings_enabled') == '3')
											<input id="isPermanent" name="is_permanent" type="hidden" value="{{ old('is_permanent', $post->is_permanent) }}">
										@else
											<?php $isPermanentError = (isset($errors) && $errors->has('is_permanent')) ? ' is-invalid' : ''; ?>
											<div id="isPermanentBox" class="row mb-3 required hide">
												<label class="col-md-12 text-start col-form-label"></label>
												<div class="col-md-12">
													<div class="form-check">
														<input id="isPermanent" name="is_permanent"
															   class="form-check-input mt-1{{ $isPermanentError }}"
															   value="1"
															   type="checkbox" {{ (old('is_permanent', $post->is_permanent)=='1') ? 'checked="checked"' : '' }}
														>
														<label class="form-check-label mt-0" for="is_permanent">
															{!! t('is_permanent_label') !!}
														</label>
													</div>
													<div class="form-text text-muted">{{ t('is_permanent_hint') }}</div>
													<div style="clear:both"></div>
												</div>
											</div>
										@endif


										<div class="content-subheading">
											<i class="fas fa-user"></i>
											<strong>{{ t('seller_information') }}</strong>
										</div>
										
										
										{{-- contact_name --}}
										<?php $contactNameError = (isset($errors) && $errors->has('contact_name')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $contactNameError }}" for="contact_name">
												{{ t('your_name') }} <sup>*</sup>
											</label>
											<div class="col-md-12 col-lg-12 col-xl-12">
												<div class="input-group">
													<span class="input-group-text"><i class="far fa-user"></i></span>
													<input id="contactName" name="contact_name"
														   type="text"
														   placeholder="{{ t('your_name') }}"
														   class="form-control input-md{{ $contactNameError }}"
														   value="{{ old('contact_name', $post->contact_name) }}"
													>
												</div>
											</div>
										</div>
										
										{{-- auth_field (as notification channel) --}}
										@php
											$authFields = getAuthFields(true);
											$authFieldError = (isset($errors) && $errors->has('auth_field')) ? ' is-invalid' : '';
											$usersCanChooseNotifyChannel = isUsersCanChooseNotifyChannel();
											$authFieldValue = (isset($post->auth_field) && !empty($post->auth_field)) ? $post->auth_field : getAuthField();
											$authFieldValue = ($usersCanChooseNotifyChannel) ? (old('auth_field', $authFieldValue)) : $authFieldValue;
										@endphp
										@if ($usersCanChooseNotifyChannel)
											<div class="row mb-3 required">
												<label class="col-md-12 text-start col-form-label" for="auth_field">{{ t('notifications_channel') }} <sup>*</sup></label>
												<div class="col-md-12">
													@foreach ($authFields as $iAuthField => $notificationType)
														<div class="form-check form-check-inline pt-2">
															<input name="auth_field"
																   id="{{ $iAuthField }}AuthField"
																   value="{{ $iAuthField }}"
																   class="form-check-input auth-field-input{{ $authFieldError }}"
																   type="radio" {{ ($authFieldValue == $iAuthField) ? 'checked' : '' }}
															>
															<label class="form-check-label mb-0" for="{{ $iAuthField }}AuthField">
																{{ $notificationType }}
															</label>
														</div>
													@endforeach
													<div class="form-text text-muted">
														{{ t('notifications_channel_hint') }}
													</div>
												</div>
											</div>
										@else
											<input id="{{ $authFieldValue }}AuthField" name="auth_field" type="hidden" value="{{ $authFieldValue }}">
										@endif
										
										@php
											$forceToDisplay = isBothAuthFieldsCanBeDisplayed() ? ' force-to-display' : '';
										@endphp
										
		
										
										{{-- phone --}}
										@php
											$phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : '';
											$phoneValue = $post->phone ?? null;
											$phoneCountryValue = $post->phone_country ?? config('country.code');
											$phoneValue = phoneE164($phoneValue, $phoneCountryValue);
											$phoneValueOld = phoneE164(old('phone', $phoneValue), old('phone_country', $phoneCountryValue));
										@endphp
										<div class="row mb-3 auth-field-item required{{ $forceToDisplay }}">
											<label class="col-md-12 text-start col-form-label{{ $phoneError }}" for="phone">{{ t('phone_number') }}
												@if (getAuthField() == 'phone')
													<sup>*</sup>
												@endif
											</label>
											<div class="col-md-12 col-lg-12 col-xl-12">
												<div class="input-group">
													<input id="phone" name="phone"
														   class="form-control input-md{{ $phoneError }}"
														   type="text"
														   value="{{ $phoneValueOld }}"
													>
													<span class="input-group-text iti-group-text">
														<input id="phoneHidden" name="phone_hidden" type="checkbox"
															   value="1" {{ (old('phone_hidden', $post->phone_hidden)=='1') ? 'checked="checked"' : '' }}>
														&nbsp;<small>{{ t('Hide') }}</small>
													</span>
												</div>
												<input name="phone_country" type="hidden" value="{{ old('phone_country', $phoneCountryValue) }}">
											</div>
										</div>


										{{-- fixed phone  --}}
										<?php $fixedPhoneError = (isset($errors) && $errors->has('fixed_phone')) ? ' is-invalid' : ''; ?>
										<div id="address_box" class="row mb-3 required">
											<label class="col-md-12 text-start col-form-label{{ $fixedPhoneError }}" for="fixed_phone">{{ t('fixed phone') }} <sup>*</sup></label>
											<div class="col-md-12">
											<input placeholder="02166991133" id="fixed_phone" name="fixed_phone"
												class="form-control input-md{{ $fixedPhoneError }}"
												type="text"
												value="{{ old('fixed_phone') }}">
											</div>
										</div>

										{{-- Button --}}
										<div class="row mb-3 pt-3">
											<div class="col-md-12 text-center">
												<a href="{{ \App\Helpers\UrlGen::post($post) }}" class="btn btn-default btn-lg">{{ t('Back') }}</a>
												<button id="nextStepBtn" class="btn btn-primary btn-lg">{{ t('Update') }}</button>
											</div>
										</div>

									</fieldset>
								</form>
								
							</div>
						</div>
					</div>
				</div>
				<!-- /.page-content -->

				<div class="col-md-3 reg-sidebar">
					@includeFirst([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.right-sidebar', 'post.createOrEdit.inc.right-sidebar'])
				</div>
				
			</div>
		</div>
	</div>
	@includeFirst([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.category-modal', 'post.createOrEdit.inc.category-modal'])
@endsection



@section('after_styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">
@endsection

@section('after_scripts')

<script>
		defaultAuthField = '{{ old('auth_field', $authFieldValue ?? getAuthField()) }}';
		phoneCountry = '{{ old('phone_country', ($phoneCountryValue ?? '')) }}';
	</script>

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
<script>
	var theme = 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';
			var lat = $('#utf_single_listingmap').data('lat');
			var lon = $('#utf_single_listingmap').data('lon');
			var macarte = null;
			var marker;
			var popup = L.popup();

			function initMap(){
				macarte = L.map('utf_single_listingmap').setView([lat, lon], 15);
				marker = L.marker({lat, lon}).addTo(macarte)
				macarte.addLayer(marker);
				L.tileLayer(theme, {}).addTo(macarte);
				macarte.on('click', onMapClick);
			}


			function onMapClick(e) {
				macarte.removeLayer(marker)
				marker = L.marker(e.latlng).addTo(macarte)
				macarte.addLayer(marker);
				$('#latitude').val(e.latlng.lat)
				$('#longitude').val(e.latlng.lng)
			}

			
	

			$(document).ready(function(){
				initMap();

				if($('#province_id').val() && $('#province_id').val() != 0){
					getProvinceCities($($('#province_id')))
				}

				
				$('#province_id').select2();
				$('#cityS2Id').select2();
			
				$('#province_id').on('change', function(){

					$('#cityBox').removeClass('d-none')
					getProvinceCities($(this))
			
				})

				function getProvinceCities(obj){
					$.ajax({
						method: 'POST',
						url: siteUrl + '/ajax/city',
						data: {
							code: obj.val()
						}
					}).done(function (xhr) {
						$('#cityS2Id').empty()
						$('#cityS2Id').append('<option selected value="0">یک محدوده را انتخاب کنید</option>');
						for(var n of xhr){
							$('#cityS2Id').append('<option data-lat="'+ n.latitude  +'" data-lon="'+ n.longitude +'" value="' + n.id + '">' + n.name + '</option>').val(n.id);
						}

						$('#cityS2Id').val($('#cityS2Id').data('value'))
						$('#cityS2Id').trigger('change')
						$('#cityS2Id').select2();
					});

					$('#cityS2Id').select2();
				}



				$('#cityS2Id').on('change', function(e) {
					res = $(this).select2('data').find(x => x.id == $(this).val())
					if(!res.element.getAttribute('data-lat') || !res.element.getAttribute('data-lon')) return;
	
					var lat = res.element.getAttribute('data-lat') ;
					var lon = res.element.getAttribute('data-lon');
	
					$('#latitude').val(lat);
					$('#longitude').val(lon);
	
					macarte.setView([lat, lon], 15)
					macarte.removeLayer(marker)
					marker = L.marker({lat, lon}).addTo(macarte)
					macarte.addLayer(marker);
					
				})

			});
			
</script>


@endsection

@includeFirst([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.form-assets', 'post.createOrEdit.inc.form-assets'])
