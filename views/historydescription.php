<div id="description" class="eleven columns">
	<h2>Description</h2>
	<p><?php echo $data->description; ?></p>
</div>

<?php if (isset($data->histories)): ?>
<div id="history" class="eleven columns">
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
	<div id="features" class="eleven columns">
		<h2>Features</h2>
		<ul class="square">
		<?php foreach($data->features as $feature){
			echo '<li>', $feature, '</li>';
		} ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(isset($data->games)): ?>
	<div id="games" class="eleven columns">
		<h2>Projects</h2>
		<ul class="square">
		<?php foreach($data->games as $game){
			echo '<li>', ViewHelper::link($game->directory, $game->title), '</li>';
		} ?>
		</ul>
	</div>
<?php endif; ?>

<hr class="sixteen columns" />