<div id="images" class="twelve columns">
	<h2>Images</h2>
	<?php if(isset($zip)): ?>
		<p><a href="<?php echo $zip; ?>">Download all images as an archive.</a></p>
	<?php endif; ?>
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
	<h2>Logo</h2>
	<?php if(isset($zip)): ?>
		<p><a href="<?php echo $zip; ?>">Download all logo as an archive.</a></p>
	<?php endif; ?>
	<a href="<?php echo $logo; ?>"><img class="twelve columns alpha omega" src="<?php echo $logo; ?>" alt="Logo" /></a>
</div>

<hr class="twelve columns" />
<?php endif; ?>

