<?php if ($data->images != null) : ?>
<div id="images" class="twelve columns">
	<h2>Images
		<?php if($data->imageZip != ""): ?>
			<a class="download" title="Download all images as an archive" href="/<?php echo BASE_PATH . $data->imageZip; ?>"><?php echo ViewHelper::icon('download'); ?></a>
		<?php endif; ?>
	</h2>
	<ul>
	<?php 
	$count = 0;
	$isodd = sizeof($data->images) % 2 == 1;
	foreach($data->images as $image) {
		$class = 'six columns ';

		// if there's an odd number of images, display the first one big 
		if ($count == 0 && $isodd) {
			$class = 'twelve columns alpha omega';

		// if not, just alternate between alpha and omega
		} else {
			$class .= ViewHelper::alphaomega($count, $isodd);
		}
		?>
			<li class="<?php echo $class; ?>">
				<a class="widescreen" href="/<?php echo BASE_PATH . $image; ?>" style="background-image: url(/<?php echo BASE_PATH . $image; ?>);" ></a>
			</li>
		<?php 
		$count++;
	};
	?>
	</ul>
</div>

<hr class="twelve columns" />
<?php endif; ?>

<?php if(isset($data->logo)): ?>
<div id="logo" class="twelve columns">
	<h2>Logo
		<?php if($data->logoZip != ""): ?>
			<a class="download" title="Download all logos as an archive" href="/<?php echo BASE_PATH . $data->logoZip; ?>"><?php echo ViewHelper::icon('download'); ?></a>
		<?php endif; ?>
	</h2>
	<a href="/<?php echo BASE_PATH . $data->logo; ?>"><img class="twelve columns alpha omega" src="/<?php echo BASE_PATH . $data->logo; ?>" alt="Logo" /></a>
</div>

<hr class="twelve columns" />
<?php endif; ?>