<div id="team" class="eight columns">
	<h2>Team & Repeating Collaborators</h2>
	<dl>
	<?php 
	foreach($data->credits as $credit) {
		if(isset($credit['website'])) {
			echo '<dt>', ViewHelper::link($credit['website'], $credit['person']), '</dt>';
		} else {
			echo '<dt>', $credit['person'], '</dt>';
		}
		echo '<dd>', $credit['role'], '</dd>';
	} ?>
	</dl>
</div>

<div id="contact" class="eight columns">
	<h2>Contact</h2>
	<dl>
	<?php 
	foreach($developer->contacts as $contact) {
		echo '<dt>', $contact['name'], '</dt>';
		if(isset($contact['mail'])) {
			echo '<dd>', ViewHelper::email($contact['mail']), '</dd>';
		} else {
			echo '<dd>', ViewHelper::link($contact['link']), '</dd>';
		}
		
	} ?>
	</dl>
</div>