<!doctype html>
<html lang="en" ng-app="dailyEatCheapApp">
<head>
	<meta charset="UTF-8">
	<link href='https://fonts.googleapis.com/css?family=Norican|Roboto:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<base href="/">
	<title>Daily Eat Cheap</title>
	<?php wp_head(); ?>
</head>
<body>

	<header>
		<h1 class="site-title"><a href="<?php echo get_site_url(); ?>"><span>Daily</span>Eat Cheap</a></h1>
		<div id="menu-toggle" ng-click="menuToggle()">
			<span></span>
            <span></span>
            <span></span>
		</div>
	</header>

	<div class="content">
		<div menu-toggle></div>
		<div ui-view></div>
	</div>

	<footer>
		<p class="copyright">&copy; <?php echo date( 'Y' ); ?> Daily Eat Cheap</p>
		<a href="http://yelp.com" target="_blank" class="yelp-link"><img src="wp-content/themes/dailyEatCheap/app/images/yelp_powered_btn_dark@2x.png" alt="Powerd by Yelp"/></a>
	</footer>

</body>
</html>