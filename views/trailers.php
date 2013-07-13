<?php 
	function videolink($key, $label, $data, $list){
		if (!isset($data[$key])) return;
		$list[] = ViewHelper::link('trailers/' . $data[$key], $label);
	}
?>
<div id="trailers" class="sixteen columns">
	<h2>Videos</h2>
	<?php foreach($trailers as $trailer){
		$links = array();
		videolink('youtube', 'YouTube', $trailer, &$links);
		videolink('vimeo', 'Vimeo', $trailer, &$links);
		videolink('mov', '.MOV', $trailer, &$links);
		videolink('mp4', '.MP4', $trailer, &$links);

		echo '<p class="videolinks">', implode(', ', $links), '</p>';

		// embeds
		if(isset($trailer['youtube'])){
			echo '<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' . $trailer['youtube'] . '?autohide=1&amp;hd=1&amp;controls=1&amp;modestbranding=1&amp;rel=0&amp;showinfo=1&amp;allowfullscreen" frameborder="0" allowfullscreen></iframe>';
		} else if (isset($trailer['vimeo'])){
			echo '<iframe src="http://player.vimeo.com/video/' . $trailer['vimeo'] . '" width="100%" height="100%"  frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		}
	}
	?>
</div>