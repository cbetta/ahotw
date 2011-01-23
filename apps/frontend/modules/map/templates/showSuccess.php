<div data-role="page" id="map">
	<div data-role="header">
		<h1>Map</h1>
	</div>
	
	<?php
		$floor_url = '';
		if ($sf_params->get('location') == 'Ground Floor') {
			$floor_url = sfConfig::get('app_maps_ground_floor_bm');
		}
		elseif ($sf_params->get('location') == 'Upper Floor') {
			$floor_url = sfConfig::get('app_maps_upper_floor_bm');
		}
		elseif ($sf_params->get('location') == 'Lower Floor') {
			$floor_url = sfConfig::get('app_maps_lower_floor_bm');
		}
	?>

	<div data-role="content">
		<img src='<?php echo $floor_url ?>' />
	</div>
</div>