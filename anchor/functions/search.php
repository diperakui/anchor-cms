<?php

/**
	Theme functions for search
*/
function has_search_results() {
	if($items = Registry::get('search')) {
		return $items->length() > 0;
	}
	
	return false;
}

function total_search_results() {
	if($total = Registry::get('total_search')) {
		return $total;
	}
	
	return 0;
}

function search_results() {
	$posts = Registry::get('search');

	if($result = $posts->valid()) {	
		// register single post
		IoC::instance('article', $posts->current(), true);
		
		// move to next
		$posts->next();
	}

	return $result;
}

function search_term() {
	$path = Config::get('application.base_url') . Config::get('application.index_page');
	$uri = Uri::current();

	// remove path
	if(strpos($uri, $path) === 0) {
		$uri = substr($uri, strlen($path));
	}

	$uri = trim($uri, '/');

	$segments = explode('/', $uri);

	return (count($segments) == 2 and $segments[0] == 'search') ? $segments[1] : '';
}

function search_next($text = 'Next', $default = '') {
	$per_page = Config::get('meta.posts_per_page');
	$offset = Input::get('offset', 0);
	$total = Registry::get('total_search');

	$pages = floor($total / $per_page);
	$page = $offset / $per_page;

	if($page < $pages) {
		return '<a href="' . current_url() . '?offset=' . ($offset + $per_page) . '">' . $text . '</a>';
	}

	return $default;
}

function search_prev($text = 'Previous', $default = '') {
	$per_page = Config::get('meta.posts_per_page');
	$offset = Input::get('offset', 0);
	$total = Registry::get('total_search');

	$pages = ceil($total / $per_page);
	$page = $offset / $per_page;

	if($offset > 0) {
		return '<a href="' . current_url() . '?offset=' . ($offset - $per_page) . '">' . $text . '</a>';
	}

	return $default;
}