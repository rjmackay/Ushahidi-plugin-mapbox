<table style="width: 630px;" class="my_table">
	<tr>
		<td>
			<span class="big_blue_span"><?php echo Kohana::lang('ui_main.step');?> 1:</span>
			<p>
				Create a public access token on your Mapbox account. If you need help, follow support from Mapbox: <a href="https://www.mapbox.com/help/create-api-access-token/">How do I create an API access token?</a>
			</p>
		</td>
		<td>
			<h4 class="fix">Public Access Token:</h4>
			<?php print form::input('mapbox_access_token', $mapbox_access_token, ' class="text title_2"'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<span class="big_blue_span"><?php echo Kohana::lang('ui_main.step');?> 2:</span>
			<p>
				Your map ID is the ID that uniquely identifies your Mapbox map. If you need help, follow support from Mapbox: <a href="https://www.mapbox.com/help/define-map-id/">What is a map ID?</a>
			</p>
		</td>
		<td>
			<h4 class="fix">Map ID:</h4>
			<?php print form::input('mapbox_map_id', $mapbox_map_id, ' class="text title_2"'); ?>
		</td>
	</tr>
</table>
