<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo ViewHelper::$title; ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="skeleton/stylesheets/base.css">
	<link rel="stylesheet" href="skeleton/stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="skeleton/images/favicon.ico">
	<link rel="apple-touch-icon" href="skeleton/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="skeleton/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="skeleton/images/apple-touch-icon-114x114.png">

</head>
<body>

	<!-- Primary Page Layout
	================================================== -->
	<div class="container">
		<?php if(sizeof(ErrorHelper::$errors)){
			echo '<ul id="errors" class="sixteen columns">';
			foreach(ErrorHelper::$errors as $error){
				echo '<li>', $error, '</li>';
			}
			echo '</ul>';
		} ?>

		<div id="menu" class="four columns">
			<ul>

			</ul>
		</div>

		<div id="dummy-menu" class="four columns">&nbsp;</div>

		<?php echo $content; ?>
	</div><!-- container -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/presskit.js" type="text/javascript"></script>	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</body>
</html>