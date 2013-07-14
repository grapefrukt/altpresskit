<div id="additionals" class="sixteen columns">
	<h2>Additional Links</h2>
	
	<?php foreach($data->additionals as $additional): ?>
		<dt><?php echo $additional['title']; ?></dt>
		<dd><?php echo $additional['description'], ' ', ViewHelper::link($additional['link']); ?></dd>
	<?php endforeach; ?>
</div>

<hr class="sixteen columns" />