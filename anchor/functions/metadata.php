<?php

/**
	Theme functions for meta
*/
function site_name() {
	return Config::get('meta.sitename');
}

function site_description() {
	return Config::get('meta.description');
}

/*
	Twitter
*/
function twitter_account() {
	return Config::get('meta.twitter');
}

function twitter_url() {
    return 'http://twitter.com/' . twitter_account();
}

