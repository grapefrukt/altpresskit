<div id="factsheet" class="five columns">
	<h2>Factsheet</h2>
	<dl>
		<dt>Developer:</dt>
		<dd><?php echo $developer->title; ?></dd>
		<dd>Based in: <?php echo $developer->basedIn; ?></dd>

		<dt>Release date:</dt>
		<dd><?php echo $data->releaseDate; ?></dd>

		<dt>Platforms:</dt>
		<?php 
		foreach($data->platforms as $platform) {
			if(isset($platform['link'])) {
				echo '<dd>', ViewHelper::link($platform['link'], $platform['name']), '</dd>';
			} else {
				echo '<dd>', $platform['name'], '</dd>';
			}
		}
		?>

		<dt>Website:</dt>
		<dd><?php echo ViewHelper::link($data->website); ?></dd>

		<dt>Regular Price:</dt>
		<?php foreach($data->prices as $price): ?>
			<dl class="prices">
				<dt><?php echo $price['currency']; ?></dt>
				<dd><?php echo $price['value']; ?></dd>
			</dl>
		<?php endforeach; ?>

	</dl>
</div>