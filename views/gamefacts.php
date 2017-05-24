<div id="factsheet" class="four columns">
	<h2>Factsheet</h2>
	<dl>
		<dt>Developer:</dt>
		<dd><?php echo $developer->title; ?></dd>
		<dd><?php echo $developer->basedIn; ?></dd>

		<?php
		if (isset($data->releaseDate)) {
			if($data->isDeveloper) {
				echo '<dt>Founding date:</dt>';
			} else {
				echo '<dt>Release date:</dt>';
			}
			echo '<dd>', $data->releaseDate, '</dd>';
		}?>

		<?php
		if (isset($data->platforms)) {
			echo '<dt>Platforms:</dt>';
			foreach($data->platforms as $platform) {
				if(isset($platform['link'])) {
					echo '<dd>', ViewHelper::link($platform['link'], $platform['name']), '</dd>';
				} else {
					echo '<dd>', $platform['name'], '</dd>';
				}
			}
		}
		?>

		<dt>Social:</dt>
		<?php foreach($data->socials as $social): ?>
			<dd><?php echo ViewHelper::link($social['link'], $social['name']); ?></dd>
		<?php endforeach; ?>

		<dt>Website:</dt>
		<dd><?php echo ViewHelper::link($data->website); ?></dd>

	<?php if($data->prices != null) : ?>
	<table class="prices">
		<?php foreach($data->prices as $key => $platform): ?>
			<caption>Regular Price <?php echo $key != null ? '(' . $key . ')' : ''; ?></caption>
			<?php foreach($platform as $price): ?>
				<tr>
					<td><?php echo $price['currency']; ?></td>
					<td><?php echo $price['value']; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>