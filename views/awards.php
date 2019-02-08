<?php if(isset($data->awards)): ?>
<div id="awards" class="twelve columns">
	<h2>Awards &amp; Recognition</h2>
	<ul>
	<?php 
	$count = 0;
	$isodd = sizeof($data->awards) % 2 == 1;
	$row = 0;
	foreach($data->awards as $award): 
		$class = 'six columns ';	
	
		// if there's an odd number of awards, display the first one big 
		if ($count == 0 && $isodd) {
			$class = 'twelve columns alpha omega';
		// if not, just alternate between alpha and omega
		} else {
			$class .= ViewHelper::alphaomega($count, $isodd);
		}
		?>
	<li class="<?php echo $class; ?>">
		<blockquote>
			<span><?php echo $award['description']; ?></span>
			<footer><?php echo $award['info']; ?></footer>
		</blockquote>
	</li>
	<?php 
	
	// figure out if we're at the last item of a row, differently depending on if we used a "isodd" big element to start
	// also, make sure we're not at the last element in the list
	// if both are true, we "restart" the list, as to keep the rows from flowing into eachother
	if (($isodd && ($count - 1) % 2 == 1) || 
			(!$isodd && $count % 2 == 1) 
			&& $count < sizeof($data->awards) - 1){
				echo "</ul>\n\t<ul style=\"clear: both;\">\n";
	}
	
	$count++;
	endforeach; 
	?>
	</ul>
</div>

<hr class="twelve columns" />

<?php endif; ?>