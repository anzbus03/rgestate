	<?php
	if (Yii::app()->isAppName('backend')) { ?>
		<div class="clearfix"><!-- --></div>
		<div class="row  form-group" <?php if (Yii::app()->isAppName('backend')) { ?> style="padding-bottom:15px;" <?php } ?>>
			<div class="col-sm-5 text-right" style="text-align:right">
				<?php echo $form->labelEx($model, 'country'); ?>
			</div>
			<div class="col-sm-7">
				<?php $mer =  array_merge(); ?>
				<?php echo $form->dropDownList($model, 'country', Countries::model()->ListData(), $model->getHtmlOptions('country', array('empty' => $this->tag->getTag('select', 'Select'), 'class' => 'input-text  form-control', 'data-url' => Yii::app()->createUrl('ajax/select_city_new'), 'onchange' => 'load_via_ajax22(this,"state")'))); ?>
				<?php echo $form->error($model, 'country'); ?>
			</div>

		</div>

	<?php } else {
	?>
		<?php echo $form->hiddenField($model, 'country'); ?>
		<?php echo $form->error($model, 'country'); ?>
	<?php
	}
	?>

	<?php
	$cities = CHtml::listData(MainRegion::model()->getStateWithCountry_2((int) $model->country), 'region_id', 'name');
	// print_r(MainRegion::model()->getStateWithCountry_2((int) $model->country));
	$m_class = empty($cities) ? 'hidden' : '';
	?>


	<div class="clearfix"><!-- --></div>
	<div class="row  form-group">
		<div class="col-sm-5 text-right" style="text-align:right">
			<?php echo $form->labelEx($model, 'state'); ?>
		</div>
		<div class="col-sm-7">
			<?php $mer =  array_merge(); ?>
			<?php echo $form->dropDownList($model, 'city', $cities, $model->getHtmlOptions('country', array('empty' => $this->tag->getTag('select', 'Select City'), 'class' => 'input-text  form-control', 'onchange' => 'changeMap()'))); ?>
			<?php echo $form->error($model, 'city'); ?>
		</div>
	</div>
	<div class="clearfix"><!-- --></div>
	<div class="row">
		<div class="form-group col-sm-12">
			<div style="clear:both;padding:5px 5px 5px 0px;color:var(--secondary-color);font-weight:bold;font-size:15px;"><?php echo $this->tag->getTag('enter_property_location', 'Enter property location'); ?>.</div>
			<?php
			if (Yii::App()->isAppName('backend')  and !$model->isNewRecord) {
				echo $model->getTranslateHtml('area_location');
			}
			?>

			<div style="position:relative;clear:both;" class="a-loct-c">
				<label for="PlaceAnAd_area_location" style="display:inline;">
					<div class="leftc"></div>
				</label style="display:inline;">
				<div class="rightc"></div>
				<?php echo $form->textField($model, 'area_location', array('class' => 'form-control', 'placeholder' => $this->tag->getTag('locate_your_property', "Locate your property")));  ?>
			</div>
			<?php echo $form->error($model, 'area_location'); ?>
		</div>
	</div>
	<div style="clear:both"></div>
	<style>
		.overfloe {
			overflow-y: hidden;
			height: 100vh;
		}

		.zoomer-t img {
			width: 22px;
		}

		.zoomer-t {
			display: none;
		}

		.zoomer-t.opn-mp {
			display: block;
		}

		.zoomer-t {
			position: absolute;
			right: 0;
			width: 30px;
			height: 30px;
			background-color: #fff;
			z-index: 111;
			cursor: pointer;
			padding: 1px 4px;
			box-shadow: 0 1px 6px 0 rgb(32 33 36 / 28%);
		}

		.zoomer-l {
			display: none;
		}

		.zoomer-l img {
			width: 30px;
			height: 30px;
			margin: auto;
		}

		.opened-full .zoomer-l {
			display: block;
			position: fixed;
			right: 5px;
			width: 50px;
			height: 50px;
			background-color: #fff;
			padding: 10px;
			z-index: 9999999999;
			cursor: pointer;
			top: 5px;
			box-shadow: 0 1px 6px 0 rgb(32 33 36 / 28%);
		}

		.opened-full .zoomer-t {
			display: none;
		}

		.opened-full #map_canvas {
			position: fixed !important;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0px;
			height: 100% !important;
			z-index: 999999999;
		}
	</style>
	<script>
		function zoomMap(k) {
			$('#map_parent').addClass('opened-full');
			$('body').addClass('overfloe')
		}

		function zoomMapminus(k) {
			$('#map_parent').removeClass('opened-full');
			$('body').removeClass('overfloe');
		}
	</script>
	<div id="map_parent" class="form-group col-sm-12;positio:relative" style="position:relative">
		<div class="zoomer-t" onclick="zoomMap(this)"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/full-screen.png'); ?>" /></div>
		<div class="zoomer-l" onclick="zoomMapminus(this)"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/closen.png'); ?>" class=" "></div>
		<div style="height:auto;width: 100%;" id="map_canvas"></div>
	</div>
	<?php
	echo $form->hiddenField($model, 'location_latitude');
	echo $form->hiddenField($model, 'location_longitude');
	?>
	<?php echo $form->error($model, 'location_latitude'); ?>


	<script type="text/javascript" src="<?php echo  'https://maps.googleapis.com/maps/api/js?libraries=places&key=' . Yii::app()->options->get('system.common.google_map_api_key', 'AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ'); ?>&language=<?php echo LANGUAGE; ?>"></script>
	<script>
		const componentForm = {

			route: "long_name",
			locality: "long_name",
			administrative_area_level_1: "short_name",

		};

		function fillInAddress5() {
			var place = autocomplete.getPlace();
			var placeTitle = '';
			for (const component of place.address_components) {
				const addressType = component.types[0];

				if (componentForm[addressType]) {
					const val = component[componentForm[addressType]];
					placeTitle += val + ', ';
				}
			}



			var lat = place.geometry.location.lat();
			var lng = place.geometry.location.lng();
			var latlng = new google.maps.LatLng(lat, lng);
			initMap(lat, lng);
			placeMarker(latlng);
			$('#PlaceAnAd_location_latitude').val(lat);
			$('#PlaceAnAd_location_longitude').val(lng);
			if (placeTitle != '') {
				placeTitle = placeTitle.replace(/,\s*$/, "");
				//  $('#PlaceAnAd_area_location').val(placeTitle);return false; 
			}
		}
	</script>
	<?php
	if (Yii::App()->isAppName('frontend')) { ?>
		<script>
			console.log(2);
		</script>
		<script>
			function initAutoCompleteNew(code) {}

			function initAutocomplete34() {
				console.log(3);
				console.log('<?php echo COUNTRY_CODE; ?>');
				var input = document.getElementById('PlaceAnAd_area_location');
				var options = {

					componentRestrictions: {
						country: '<?php echo COUNTRY_CODE; ?>'
					},

				};

				autocomplete = new google.maps.places.Autocomplete(input, options);
				autocomplete.addListener('place_changed', fillInAddress5);

			}

			$(function() {
				console.log(4);
				initAutocomplete34();

			})
		</script>

	<?php } else {
	?>
		<script>
			function initAutoCompleteNew(code) {

				var input = document.getElementById('PlaceAnAd_area_location');
				var options = {
					componentRestrictions: {
						country: code
					},
				};
				autocomplete = new google.maps.places.Autocomplete(input, options);
				autocomplete.addListener('place_changed', fillInAddress5);
			}
			<?php
			$country_code = 'ae';
			if (!empty($country_code)) {  ?>


				function initAutocomplete2() {
					var input = document.getElementById('PlaceAnAd_area_location');
					var options = {

						componentRestrictions: {
							country: '<?php echo $country_code; ?>'
						},

					};

					autocomplete = new google.maps.places.Autocomplete(input, options);
					autocomplete.addListener('place_changed', fillInAddress5);

				}

				$(function() {
					initAutocomplete2();

				})

			<?php }   ?>
		</script>
	<?php
	}

	?>
	<script>
		var modelName = '<?php echo $model->modelName; ?>';
		<?php
		if ($model->location_latitude != "" and $model->location_longitude != "") {
		?>
			initMap('<?php echo $model->location_latitude; ?>', '<?php echo $model->location_longitude; ?>');
			var latlng = new google.maps.LatLng('<?php echo $model->location_latitude; ?>', '<?php echo $model->location_longitude; ?>');
			placeMarker(latlng);
		<?php
		}
		?>

		function load_via_ajax22(k, id) {
			var url_load = $(k).attr('data-url')
			if (url_load !== undefined) {
				url_load += '/id/' + $(k).val();

				$('#' + modelName + '_' + id).val('');
				$('#' + modelName + '_' + id).html('<option value="">Loading...</option>');

				$.get(url_load, function(data) {
					var data = JSON.parse(data);
					$('#' + modelName + '_' + id).html(data.data);
				})
			}
		}


		function changeMapold() {

			var location_text = '';
			if ($('#' + modelName + '_state').val() != '') {
				location_text += $('#' + modelName + '_state option:selected').text();
			}
			if (location_text != '') {
				codeAddressInitial(location_text);
			}
		}

		function initMap(lati, longi) {
			$('.zoomer-t').addClass('opn-mp')
			$('#map_canvas').css({
				'height': '400px'
			});
			var latlng = new google.maps.LatLng(lati, longi);
			var myOptions = {
				zoom: 14,
				center: latlng,
				disableDefaultUI: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE,
					position: google.maps.ControlPosition.RIGHT_CENTER
				},

			};
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			geocoder = new google.maps.Geocoder();
			google.maps.event.addListener(map, "click", function(event) {
				geocoder.geocode({
					'latLng': event.latLng
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						if (results[0]) {

							$('#' + modelName + '_area_location').val(results[0].formatted_address)
						}
					}
				});
				placeMarker(event.latLng);
				sun(event.latLng.lat(), event.latLng.lng())
				window.changelocation = false;
			});
		}
	</script>