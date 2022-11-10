@if (config('services.googlemaps.key'))
	<?php
	$mapHeight = 400;
	$mapPlace = (isset($city) && !empty($city))
		? $city->name . ', ' . config('country.name')
		: config('country.name');
	$mapUrl = getGoogleMapsEmbedUrl(config('services.googlemaps.key'), $mapPlace);
	?>
	<div class="intro-inner" style="height: {{ $mapHeight }}px;">
		<iframe
				id="googleMaps"
				width="100%"
				height="{{ $mapHeight }}"
				style="border:0;"
				loading="lazy"
				title="{{ $mapPlace }}"
				aria-label="{{ $mapPlace }}"
				src="{{ $mapUrl }}"
		></iframe>
	</div>
@endif

@section('after_scripts')
	@parent
@endsection