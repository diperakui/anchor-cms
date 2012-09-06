<?php

/*
	Anchor setup
*/
define('IS_ADMIN', in_array('admin', explode('/', Uri::current())));

// Check installation
/*
if(Config::load(PATH . 'config.php') === false) {
	// looks like we are missing a config file
	echo "<html><h2>Missing config file</h2>
		<p>It looks like the config file is missing or unreadable.</p>
		<p><a href=\"./install\">Run the installer</a></p></html>";

	exit(1);
}
*/

// load database metadata
foreach(Query::table('meta')->get() as $item) {
	$meta[$item->key] = $item->value;
}

Config::set('meta', $meta);

if( ! IS_ADMIN) {
	// include global theming functions
	$fi = new FilesystemIterator(APP . 'functions', FilesystemIterator::SKIP_DOTS);

	foreach($fi as $file) {
		if($file->isFile() and $file->isReadable() and $file->getExtension() == 'php') {
			require $file->getPathname();
		}
	}

	// include theme functions
	if(is_readable($path = PATH . 'themes' . DS . Config::get('meta.theme') . DS . 'functions.php')) {
		require $path;
	}
}

// register home page
Registry::set('home_page', Page::home());

// register posts page
Registry::set('posts_page', Page::posts());

// register categories
foreach(Category::all() as $itm) {
	$categories[$itm->id] = $itm;
}

Registry::set('all_categories', $categories);

function __($line, $default = 'No language replacement') {
	return Language::line($line, $default);
}

// include admin functions
if(IS_ADMIN) {
	function asset($path) {
		return Config::get('application.base_url') . 'anchor/views/assets/' . $path;
	}

	function url($path) {
		return Config::get('application.base_url') . 'admin/' . $path;
	}

	function site($path = '') {
		return Config::get('application.base_url') . Config::get('application.index_page') . $path;
	}
}