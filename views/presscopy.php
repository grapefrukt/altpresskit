<?php if(isset($data->pressCanRequestCopy)) : ?>

<div id="presscopy" class="twelve columns row">
	<h2>Request press copy</h2>

	<?php if(strtolower($data->pressCanRequestCopy) == 'true' || $data->pressCanRequestCopy == 1) : ?>

	<form action="." >
		<fieldset class="five columns alpha">
			<label for="email">E-mail</label>
			<input type="text" id="email" name="email" />
		</fieldset>

		<fieldset class="five columns">
			<label for="publication">Publication</label>
			<input type="text" id="publication" name="publication" />
		</fieldset>

		<button class="two columns omega" type="submit">Request</button>

	</form>

	<?php else: ?>

	<p>Request a copy of this game using <a href="<?php echo $data->pressCanRequestCopy; ?>">this form</a>.</p>

	<?php endif; ?>

	<p>If you prefer you can also request a copy <a href="#contact">via e-mail</a>.</p>

</div>

<hr class="twelve columns" />

<?php endif; ?>