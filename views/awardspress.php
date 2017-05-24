<?php if(isset($data->awards)): ?>
<div id="awards" class="twelve columns">
	<h2>Awards &amp; Recognition</h2>
	<ul>
	<?php foreach($data->awards as $award): ?>
		<li>
			<em><?php echo $award['description']; ?></em>, <?php echo $award['info']; ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

<hr class="twelve columns" />

<?php endif; ?>

<?php if(isset($data->quotes)): ?>
<div id="articles" class="twelve columns">
	<h2>Selected Articles</h2>
	<ul>
	<?php foreach($data->quotes as $quote): ?>
		<li>
			<?php echo '<blockquote' . (isset($quote['link']) ? ('cite="' . $quote['link'] . '"') : '') . '>'; ?>
				<span><?php echo $quote['description']; ?></span>
				<footer><?php echo $quote['name']; ?><?php if(isset($quote['link'])) { echo ', <a href="' . $quote['link'] . '">' . $quote['website'] . '</a></footer>'; }?>
			</blockquote>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

<hr class="twelve columns" />

<?php endif; ?>