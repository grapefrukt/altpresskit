<?php if (isset($data->additionals)): ?>
<div id="additionals" class="twelve columns">
	<h2>Additional Links</h2>
	<dl>
		<?php foreach($data->additionals as $additional): ?>
			<dt><?php echo $additional['title']; ?></dt>
			<dd><?php echo $additional['description'], ' ', ViewHelper::link($additional['link']); ?></dd>
		<?php endforeach; ?>
	</dl>
</div>

<hr class="twelve columns" />
<?php endif; ?>
