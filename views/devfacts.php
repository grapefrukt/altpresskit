<div id="factsheet" class="four columns">
	<h2>Factsheet</h2>
	<dl>
		<dt>Developer:</dt>
		<dd><?php echo $data->title; ?></dd>
		<dd>Based in: <?php echo $data->basedIn; ?></dd>

		<dt>Founding date:</dt>
		<dd><?php echo $data->foundingDate; ?></dd>

		<dt>Website:</dt>
		<dd><?php echo ViewHelper::link($data->website); ?></dd>

		<dt>Press / Business Contact:</dt>
		<dd><?php echo ViewHelper::email($data->pressContact); ?></dd>

		<dt>Social:</dt>
		<?php foreach($data->socials as $social): ?>
			<dd><?php echo ViewHelper::link($social['link'], $social['name']); ?></dd>
		<?php endforeach; ?>

		<dt>Releases:</dt>
		<?php foreach($data->games as $game): ?>
			<dd><?php echo ViewHelper::linkProject($game->directory, $game->title); ?></dd>
		<?php endforeach; ?>
		
		<?php if(isset($data->phone)) : ?>
			<dt>Phone:</dt>
			<dd><?php echo ViewHelper::callto($data->phone); ?></dd>
		<?php endif; ?>
	</dl>
</div>