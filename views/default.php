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
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.png">

	<?php ViewHelper::render('analytics', array('code' => $presskit->developer->analytics)); ?>
</head>
<body>

	<!-- Primary Page Layout
	================================================== -->
	<div class="container">
		<?php if(sizeof(ErrorHelper::$errors)){
			echo '<ul class="errors sixteen columns">';
			foreach(ErrorHelper::$errors as $error){
				echo '<li>', $error, '</li>';
			}
			echo '</ul>';
		} ?>

		<header>
			<h1 class="sixteen columns"><?php echo ViewHelper::$header; ?></h1>
		</header>

		<div id="menu" class="four columns">
			<ul>
				<?php if (!ViewHelper::$isHome): ?>
					<li><a href="/<?php echo BASE_PATH; ?>">Home</a></li>
				<?php endif; ?>
				<!-- the rest of this menu is populated by js -->
			</ul>
		</div>

		<div id="dummy-menu" class="four columns">&nbsp;</div>

		<?php echo $content; ?>

		<footer class="one column offset-by-fifteen">
			<a id="creditlink" href="credits"><span>powered by alt. presskit()</span></a>
		</footer>
	</div><!-- container -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/presskit.js" type="text/javascript"></script>	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</body>
</html>
