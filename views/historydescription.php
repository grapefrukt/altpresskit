<div id="historydescription" class="eight columns alpha omega">
	<div id="description" class="eight columns">
		<h2>Description</h2>
		<p><?php echo $data->description; ?></p>
	</div>

	<?php if (isset($data->histories)): ?>
	<div id="history" class="eight columns">
		<h2>History</h2>
		<?php 
		foreach($data->histories as $history){
			if(isset($history['header'])) echo '<h3>', $history['header'], '</h3>';
			echo '<p>', $history['text'], '</p>';
		}
		?>
	</div>
	<?php endif; ?>

	<?php if(isset($data->features)): ?>
		<div id="features" class="eight columns">
			<h2>Features</h2>
			<ul class="square">
			<?php foreach($data->features as $feature){
				echo '<li>', $feature, '</li>';
			} ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php 
	$count = 0;
	if(isset($data->games)): ?>
		<div id="games" class="eight columns">
			<h2>Projects</h2>
			<ul>
			<?php
			$count = 0;
			foreach($data->games as $game) if (!isset($game->listed) || $game->listed != 0) $count++;
			
			$firstWide = $count % 2 == 1;
			$index = 0;
			foreach($data->games as $game): 
				if (isset($game->listed) && $game->listed == 0)	continue;
				?>
				<li>
					<?php
						$image = '';
						if ($game->images != null) $image = 'style="background-image: url(' . reset($game->images) . ');"';
						$style = 'four columns ';
						if ($firstWide) {
							$style = 'eight columns alpha omega tall';
							$firstWide = false;
						} else {
							$style .=  ViewHelper::alphaomega($index++);
						}
						echo ViewHelper::linkProject($game->directory . '/', $game->title, 'class="' . $style . '"' . $image); 
					?>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

</div>
<hr class="twelve columns" />