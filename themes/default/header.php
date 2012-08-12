<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo site_name(); ?></title>
		<meta name="description" content="<?php echo site_description(); ?>">

		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link rel="stylesheet" href="<?php echo theme_url('assets/css/normalize.css'); ?>">
		<link rel="stylesheet" href="<?php echo theme_url('assets/css/styles.css'); ?>">

		<link rel="alternate" type="application/rss+xml" title="<?php echo site_name(); ?>" href="<?php echo rss_url(); ?>">
		<link rel="shortcut icon" href="<?php echo theme_url('assets/img/icon.png'); ?>">
	</head>
	<body>
	
		<header id="top">
			<div class="wrap">
				
				<a id="logo" href="<?php echo base_url(); ?>"><?php echo site_name(); ?></a>
	
				<?php if(has_menu_items()): ?>
				<nav id="main" role="navigation">
					<ul>
						<?php while(menu_items()): ?>
						<li <?php echo (menu_active() ? 'class="active"' : ''); ?>>
							<a href="<?php echo menu_url(); ?>" title="<?php echo menu_title(); ?>">
								<?php echo menu_name(); ?>
							</a>
						</li>
						<?php endwhile; ?>
					</ul>
				</nav>
				<?php endif; ?>

				<form id="search" action="<?php echo search_url(); ?>" method="post">
					<input type="search" name="term" placeholder="To search, type and hit enter&hellip;" value="<?php echo search_term(); ?>">
				</form>
			</div>
		</header>

		<div class="wrap">