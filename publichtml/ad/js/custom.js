
// Login popup handle
$('.login-button').click(function(){
    $('#register').attr('data-redirect', $(this).attr('data-redirect'))

    if($(this).attr('data-close')){
      $('#register').attr('data-close', $(this).attr('data-close'))
    }else{
      $('#register').attr('data-close', null)
    }

    if($(this).attr('data-callback')){
      $('#register').attr('data-callback', $(this).attr('data-callback'))
    }else{
      $('#register').attr('data-callback', null)
    }


  })





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

				$('#province_id').select2();
				$('#city_s1_id').select2();
				$('#cityS2Id').select2();
			
				$('#province_id').on('change', function(){

					$('#cityS1Box').removeClass('d-none')

					$.ajax({
						method: 'GET',
						url: siteUrl + '/ajax/provinces/' + $(this).val() + '?languageCode=' + languageCode
					}).done(function (xhr) {
						$('#city_s1_id').empty().append('<option value="' + xhr.code + '">' + xhr.name + '</option>').val(xhr.id).trigger('change');
						return xhr.id;
					});

					$('#city_s1_id').select2();
				})

				$('#city_s1_id').on('change', function(){
					$('#cityBox').removeClass('d-none')

					$.ajax({
						method: 'GET',
						url: siteUrl + '/ajax/city/' + $(this).val() + '?languageCode=' + languageCode
					}).done(function (xhr) {
						$('#cityS2Id').empty().append('<option value="' + xhr.code + '">' + xhr.name + '</option>').val(xhr.id).trigger('change');
						return xhr.id;
					});

					$('#cityS2Id').select2();
				})


				$('#cityS2Id').on('change', function(e) {
					res = $(this).select2('data').find(x => x.id == $(this).val())
					if(!res.lat || !res.lon) return;
	
					var lat = res.lat;
					var lon = res.lon;
	
					$('#latitude').val(lat);
					$('#longitude').val(lon);
	
					macarte.setView([res.lat, lon], 15)
					macarte.removeLayer(marker)
					marker = L.marker({lat, lon}).addTo(macarte)
					macarte.addLayer(marker);
					
				})

			});
			

      
      