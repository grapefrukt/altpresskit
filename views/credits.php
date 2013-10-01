<div id="credits" class="twelve columns">
	<p>
		This presskit runs on <a href="https://github.com/grapefrukt/altpresskit">alt. presskit</a> 
		by <a href="http://grapefrukt.com/">grapefrukt</a>, version <?php echo VERSION; ?>
		<?php if(UpdateHelper::$hasUpdate) : ?>
			<span class="update"> (<abbr title="<?php echo UpdateHelper::$newVersion; ?>">Update available</abbr>)</span>
		<?php endif; ?>.
	</p>
	<p>
		Which in turn is based on <a href="http://dopresskit.com/">presskit()</a> 
		by Rami Ismail (<a href="http://www.vlambeer.com/">Vlambeer</a>) -
		<a href="http://dopresskit.com/#thanks">also thanks to these fine folks</a>
	</p>
</div>
