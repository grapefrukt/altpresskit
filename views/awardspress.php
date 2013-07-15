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

<?php if(isset($data->awards)): ?>
<div id="articles" class="twelve columns">
	<h2>Selected Articles</h2>
	<ul>
	<?php foreach($data->quotes as $quote): ?>
		<li>
			<blockquote cite="<?php echo $quote['link']; ?>">
				<span><?php echo $quote['description']; ?></span>
				<footer><?php echo $quote['name']; ?>, <a href="<?php echo $quote['link']; ?>"><?php echo $quote['website']; ?></a></footer>
			</blockquote>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

<hr class="twelve columns" />

<?php endif; ?>