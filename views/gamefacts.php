<div id="factsheet" class="four columns">
	<h2>Factsheet</h2>
	<dl>
		<dt>Developer:</dt>
		<dd><?php echo $developer->title; ?></dd>
		<dd><?php echo $developer->basedIn; ?></dd>

		<?php if($data->isDeveloper) : ?>
			<dt>Founding date:</dt>
		<?php else : ?>
			<dt>Release date:</dt>
		<?php endif; ?>
		<dd><?php echo $data->releaseDate; ?></dd>

		<dt>Platforms:</dt>
		<?php
		if (isset($data->platforms)) {
			foreach($data->platforms as $platform) {
				if(isset($platform['link'])) {
					echo '<dd>', ViewHelper::link($platform['link'], $platform['name']), '</dd>';
				} else {
					echo '<dd>', $platform['name'], '</dd>';
				}
			}
		}
		?>

		<dt>Website:</dt>
		<dd><?php echo ViewHelper::link($data->website); ?></dd>
	</dl>

	<?php if($data->prices != null) : ?>
	<table class="prices">
		<?php foreach($data->prices as $key => $platform): ?>
			<caption>Pricing <?php echo $key != null ? '(' . $key . ')' : ''; ?></caption>
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