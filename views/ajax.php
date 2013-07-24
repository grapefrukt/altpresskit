<?php
	if(sizeof(ErrorHelper::$errors)){
		echo '<ul id="errors" class="sixteen columns">';
		foreach(ErrorHelper::$errors as $error){
			echo '<li>', $error, '</li>';
		}
		echo '</ul>';
	}

	echo $content; 
?>