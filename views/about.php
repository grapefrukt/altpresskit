<div id="about" class="twelve columns">
	<h2>About <?php echo $data->title; ?></h2>
	<p><?php echo $data->description; ?></p>
	<h3>More information</h3>
	<p>More information on <?php echo $data->title; ?>, our logo &amp; relevant media are available <?php echo ViewHelper::link('/' . BASE_PATH, 'here') ?>.</p>
</div>

<hr class="twelve columns" />