<div id="images" class="twelve columns">
	<h2>Images
		<?php if(isset($zip)): ?>
			<a class="download" title="Download all logos as an archive" href="<?php echo $zip; ?>"><?php echo ViewHelper::icon('download'); ?></a>
		<?php endif; ?>
	</h2>
	<ul>
	<?php 
	$count = 0;
	foreach($images as $image) { 
		$class = '';
		if($count % 4 == 0) $class = 'alpha';
		if($count % 4 == 3) $class = 'omega'; ?>
		<li class="three columns <?php echo $class; ?>">
			<a href="<?php echo $image; ?>" style="background-image: url(<?php echo $image; ?>);" ></a>
		</li>
		<?php 
		$count++;
	};
	?>
	</ul>
</div>

<hr class="twelve columns" />

<?php if(isset($logo)): ?>
<div id="logo" class="twelve columns">
	<h2>Logo
		<?php if(isset($logoZip)): ?>
			<a class="download" title="Download all logos as an archive" href="<?php echo $logoZip; ?>"><?php echo ViewHelper::icon('download'); ?></a>
		<?php endif; ?>
	</h2>
	<a href="<?php echo $logo; ?>"><img class="twelve columns alpha omega" src="<?php echo $logo; ?>" alt="Logo" /></a>
</div>

<hr class="twelve columns" />
<?php endif; ?>

