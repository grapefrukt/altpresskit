<div id="images" class="sixteen columns">
	<h2>Images</h2>
	<ul>
	<?php 
	$count = 0;
	foreach($images as $image) { 
		$class = '';
		if($count % 4 == 0) $class = 'alpha';
		if($count % 4 == 3) $class = 'omega'; ?>
		<li class="four columns <?php echo $class; ?>">
			<a href="<?php echo $image; ?>">
				<img src="<?php echo $image; ?>" />
			</a>
		</li>
		<?php 
		$count++;
	};
	?>
	</ul>
</div>