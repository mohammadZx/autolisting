@push('after_styles_stack')
	@include('layouts.inc.tools.wysiwyg.css')
	
	{{-- Single Step Form --}}
	@if (config('settings.single.publication_form_type') == '2')
		<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
		@if (config('lang.direction') == 'rtl')
			<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
		@endif
		
		<style>
			.krajee-default.file-preview-frame:hover:not(.file-preview-error) {
				box-shadow: 0 0 5px 0 #666666;
			}
			.file-loading:before {
				content: " {{ t('loading_wd') }}";
			}
			/* Preview Frame Size */
			/*
			.krajee-default.file-preview-frame .kv-file-content,
			.krajee-default .file-caption-info,
			.krajee-default .file-size-info {
				width: 90px;
			}
			*/
			.krajee-default.file-preview-frame .kv-file-content {
				height: auto;
			}
			.krajee-default.file-preview-frame .file-thumbnail-footer {
				height: 30px;
			}
		</style>
	@endif
	
	<link href="{{ url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('after_scripts_stack')
	@include('layouts.inc.tools.wysiwyg.js')
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
	@if (file_exists(public_path() . '/assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js'))
		<script src="{{ url('assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js') }}" type="text/javascript"></script>
	@endif
	
	{{-- Single Step Form --}}
	@if (config('settings.single.publication_form_type') == '2')
		<script src="{{ url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
	@endif
	
	<script src="{{ url('assets/plugins/momentjs/moment.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
	
	<?php
	$postInput = $postInput ?? [];
	$postId = isset($post, $post->id) ? $post->id : '';
	$postTypeId = isset($post, $post->post_type_id) ? $post->post_type_id : data_get($postInput, 'post_type_id', 0);
	$countryCode = (isset($post, $post->country_code) && !empty($post->country_code)) ? $post->country_code : data_get($postInput, 'country_code', config('country.code', 0));
	$selectedAdminCode = (isset($admin) && !empty($admin)) ? $admin->code : data_get($postInput, 'admin_code', 0);
	$cityId = isset($post, $post->city_id) ? (int)$post->city_id : data_get($postInput, 'city_id', 0);
	?>
	
	<script>
		/* Translation */
		var lang = {
			'select': {
				'country': "{{ t('select_a_country') }}",
				'admin': "{{ t('select_a_location') }}",
				'city': "{{ t('select_a_city') }}"
			},
			'price': "{{ t('price') }}",
			'salary': "{{ t('Salary') }}",
			'nextStepBtnLabel': {
				'next': "{{ t('Next') }}",
				'submit': "{{ t('Update') }}"
			}
		};
		
		var stepParam = 0;
		
		/* Category */
		/* Custom Fields */
		var errors = '{!! addslashes($errors->toJson()) !!}';
		var oldInput = '{!! addslashes(collect(session()->getOldInput('cf', data_get($postInput, 'cf')))->toJson()) !!}';
		var postId = '{{ $postId }}';
		
		/* Permanent Posts */
		var permanentPostsEnabled = '{{ config('settings.single.permanent_listings_enabled', 0) }}';
		var postTypeId = '{{ old('post_type_id', $postTypeId) }}';
		
		/* Locations */
		var countryCode = '{{ old('country_code', $countryCode) }}';
		var adminType = '{{ config('country.admin_type', 0) }}';
		var selectedAdminCode = '{{ old('admin_code', $selectedAdminCode) }}';
		var cityId = '{{ old('city_id', data_get($postInput, 'city_id', $cityId)) }}';
		
		/* Packages */
		var packageIsEnabled = false;
		@if (isset($packages, $paymentMethods) && $packages->count() > 0 && $paymentMethods->count() > 0)
			packageIsEnabled = true;
		@endif
	</script>
	<script>
		{{-- Single Step Form --}}
		@if (config('settings.single.publication_form_type') == '2')
			@if (request()->segment(1) == 'create')
				{{-- Create Form --}}
				/* Images Upload */
				$('.post-picture').fileinput(
				{
					theme: 'fas',
					language: '{{ config('app.locale') }}',
					@if (config('lang.direction') == 'rtl')
					rtl: true,
					@endif
					dropZoneEnabled: false,
					overwriteInitial: true,
					showCaption: true,
					showPreview: true,
					showClose: true,
					showUpload: false,
					showRemove: false,
					previewFileType: 'image',
					allowedFileExtensions: {!! getUploadFileTypes('image', true) !!},
					minFileSize: {{ (int)config('settings.upload.min_image_size', 0) }}, {{-- in KB --}}
					maxFileSize: {{ (int)config('settings.upload.max_image_size', 1000) }}, {{-- in KB --}}
					/* Remove Drag-Drop Icon (in footer) */
					fileActionSettings: {
						dragIcon: '',
						dragTitle: ''
					},
					layoutTemplates: {
						/* Show Only Actions (in footer) */
						footer: '<div class="file-thumbnail-footer pt-2">{actions}</div>',
						/* Remove Delete Icon (in footer) */
						actionDelete: ''
					}
				});
			@else
				{{-- Edit Form --}}
				@if (isset($post, $picturesLimit) && is_numeric($picturesLimit) && $picturesLimit > 0)
					@for($i = 0; $i <= $picturesLimit-1; $i++)
						/* Images Upload */
						$('#picture{{ $i }}').fileinput(
						{
							theme: 'fas',
							language: '{{ config('app.locale') }}',
							@if (config('lang.direction') == 'rtl')
							rtl: true,
							@endif
							dropZoneEnabled: false,
							overwriteInitial: false,
							showCaption: true,
							showPreview: true,
							showClose: true,
							showUpload: false,
							showRemove: false,
							previewFileType: 'image',
							allowedFileExtensions: {!! getUploadFileTypes('image', true) !!},
							minFileSize: {{ (int)config('settings.upload.min_image_size', 0) }}, {{-- in KB --}}
							maxFileSize: {{ (int)config('settings.upload.max_image_size', 1000) }}, {{-- in KB --}}
							@if (
								isset($post->pictures) && ($post->pictures instanceof \Illuminate\Support\Collection)
								&& $post->pictures->has($i)
								&& isset($post->pictures->get($i)->filename)
								&& isset($post->pictures->get($i)->filename_url_medium)
							)
							/* Retrieve Existing Picture */
							initialPreview: [
								'<img src="{{ $post->pictures->get($i)->filename_url_medium }}" class="file-preview-image">',
							],
							initialPreviewConfig: [
							<?php
							// Get the file path
							$filePath = $post->pictures->get($i)->filename;
							
							// Get the file's deletion URL
							$deleteUrl = url('posts/' . $post->id . '/photos/' . $post->pictures->get($i)->id . '/delete');
							
							// Get the file size
							try {
								$fileSize = (isset($disk) && !empty($filePath) && $disk->exists($filePath)) ? (int)$disk->size($filePath) : 0;
							} catch (\Throwable $e) {
								$fileSize = 0;
							}
							?>
								{
									caption: '{{ basename($post->pictures->get($i)->filename) }}',
									size: {{ $fileSize }},
									url: '{{ $deleteUrl }}',
									key: {{ (int)$post->pictures->get($i)->id }}
								}
							],
							@endif
							/* Remove Drag-Drop Icon (in footer) */
							fileActionSettings: {
								showDrag: false, /* Remove move/rearrange icon */
								showZoom: false, /* Remove zoom icon */
								removeIcon: '<i class="far fa-trash-alt" style="color: red;"></i>',
								removeClass: 'btn btn-default btn-sm',
								zoomClass: 'btn btn-default btn-sm',
								indicatorNew: '<i class="fas fa-check-circle" style="color: #09c509;font-size: 20px;margin-top: -15px;display: block;"></i>'
							}
						});
					
						/* Delete picture */
						$('#picture{{ $i }}').on('filepredelete', function(jqXHR) {
							var abort = true;
							if (confirm("{{ t('Are you sure you want to delete this picture') }}")) {
								abort = false;
							}
							return abort;
						});
					@endfor
				@endif
			@endif
		@endif
		
		$(document).ready(function() {
			{{-- select2: If error occured, apply Bootstrap's error class --}}
			@if ($errors->has('admin_code'))
				$('select[name="admin_code"]').closest('div').addClass('is-invalid');
			@endif
			@if ($errors->has('city_id'))
				$('select[name="city_id"]').closest('div').addClass('is-invalid');
			@endif
			
			{{-- Tagging with multi-value Select Boxes --}}
			<?php
			$tagsLimit = (int)config('settings.single.tags_limit', 15);
			$tagsMinLength = (int)config('settings.single.tags_min_length', 2);
			$tagsMaxLength = (int)config('settings.single.tags_max_length', 30);
			?>
			let selectTagging = $('.tags-selecter').select2({
				language: langLayout.select2,
				width: '100%',
				tags: true,
				maximumSelectionLength: {{ $tagsLimit }},
				tokenSeparators: [',', ';', ':', '/', '\\', '#'],
				createTag: function (params) {
					var term = $.trim(params.term);
					
					{{-- Don't offset to create a tag if there is some symbols/characters --}}
					let invalidCharsArray = [',', ';', '_', '/', '\\', '#'];
					let arrayLength = invalidCharsArray.length;
					for (let i = 0; i < arrayLength; i++) {
						let invalidChar = invalidCharsArray[i];
						if (term.indexOf(invalidChar) !== -1) {
							return null;
						}
					}
					
					{{-- Don't offset to create empty tag --}}
					{{-- Return null to disable tag creation --}}
					if (term === '') {
						return null;
					}
					
					{{-- Don't allow tags which are less than 2 characters or more than 50 characters --}}
					if (term.length < {{ $tagsMinLength }} || term.length > {{ $tagsMaxLength }}) {
						return null;
					}
					
					return {
						id: term,
						text: term
					}
				}
			});
			
			{{-- Apply tags limit --}}
			selectTagging.on('change', function(e) {
				if ($(this).val().length > {{ $tagsLimit }}) {
					$(this).val($(this).val().slice(0, {{ $tagsLimit }}));
				}
			});
			
			{{-- select2: If error occured, apply Bootstrap's error class --}}
			@if ($errors->has('tags.*'))
				$('select[name^="tags"]').next('.select2.select2-container').addClass('is-invalid');
			@endif
		});
	</script>
	
	<script src="{{ url('assets/js/app/d.select.category.js') . vTime() }}"></script>
	<script src="{{ url('assets/js/app/d.select.location.js') . vTime() }}"></script>
@endpush
