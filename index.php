<!doctype html>
<html lang="en" ng-app="dailyEatCheapApp">
<head>
	<meta charset="UTF-8">
	<base href="/">
	<title>Daily Eat Cheap</title>
	<?php wp_head(); ?>
</head>
<body>

	<header>
		<h1><a href="<?php echo get_site_url(); ?>">Daily Eat Cheap</a></h1>
		<nav>
			<ul>
				<li><a href="/wp-admin" target="_self">Log In</a></li>
				<li><a ui-sref="submit-eat">Submit an Eat</a></li>
			</ul>
		</nav>
	</header>

	<div ui-view></div>

	<footer>
		<p>&copy; <?php echo date( 'Y' ); ?> Daily Eat Cheap</p>
		<img src="wp-content/themes/dailyEatCheap/app/images/yelp_powered_btn_dark@2x.png" alt="Powerd by Yelp"/>
	</footer>

</body>
</html>