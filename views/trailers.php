<?php 
	function videolink($key, $label, $data, $list){
		if (!isset($data[$key])) return;
		if($key == 'youtube'){
			$list[] = ViewHelper::link('http://youtu.be/' . $data[$key], $label);
		} else {
			$list[] = ViewHelper::link('trailers/' . $data[$key], $label);
		}
	}
?>
<div id="trailers" class="sixteen columns">
	<h2>Videos</h2>
	<?php 
	$count = 0;
	foreach($trailers as $trailer){
		$links = array();
		videolink('youtube', 'YouTube', $trailer, &$links);
		videolink('vimeo', 'Vimeo', $trailer, &$links);
		videolink('mov', '.MOV', $trailer, &$links);
		videolink('mp4', '.MP4', $trailer, &$links);

		$class = 'alpha';
		if ($count % 2 == 1) $class = 'omega';
		?>

		<div class="video eight columns <?php echo $class; ?>">
			<p>
				<?php if(isset($trailer['name'])) echo $trailer['name']; ?>
				<span class="videolinks"><?php echo implode(', ', $links); ?></span>
			</p>

			<div class="widescreen">
				<?php if(isset($trailer['youtube'])): ?>
					<iframe src="http://www.youtube.com/embed/<?php echo $trailer['youtube'] ?>?autohide=1&amp;hd=1&amp;controls=1&amp;modestbranding=1&amp;rel=0&amp;showinfo=1&amp;allowfullscreen" allowfullscreen></iframe>
				<?php elseif (isset($trailer['vimeo'])): ?>
					<iframe src="http://player.vimeo.com/video/'<?php echo $trailer['vimeo'] ?>" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php endif; ?>
			</div>
		</div>

		<?php
		$count++;
	}
	?>
</div>

<hr class="sixteen columns" />