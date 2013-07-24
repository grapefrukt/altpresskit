<?php if(strtolower($data->pressCanRequestCopy) == 'true' || $data->pressCanRequestCopy == 1) : ?>

<div id="presscopy" class="twelve columns">
	<h2>Request press copy</h2>
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

	<p class="twelve columns alpha omega">If you prefer you can also request a copy <a href="#contact">via e-mail</a></p>

</div>

<hr class="twelve columns" />

<?php endif; ?>