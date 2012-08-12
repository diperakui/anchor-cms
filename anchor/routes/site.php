<?php

/*
	Home page and posts page
*/
$posts_page = Registry::get('posts_page');

$home_page = Registry::get('home_page');

$callback = function($page = 1) use($posts_page) {
	$template = $posts_page->template ?: 'posts';

	Registry::set('page', $posts_page);

	Registry::set('page_offset', $page);

	return new Template($template);
};

if($home_page->id == $posts_page->id) {
	/*
		View home page and posts and paginate through them
	*/
	Route::get(array('/', $posts_page->slug, $posts_page->slug . '/(:num)'), $callback);
}
else {
	/*
		Default home page
	*/
	Route::get(array('/', $home->slug), function() use($home) {
		$template = $home->template ?: 'page';

		Registry::set('page', $home);

		return new Template($template);
	});

	/*
		View posts and paginate through them
	*/
	Route::get(array($posts_page->slug, $posts_page->slug . '/(:num)'), $callback);
}

/*
	View posts by category
*/
Route::get(array('category/(:any)', 'category/(:any)/(:num)'), function($slug, $page = 1) use($posts_page) {
	if( ! $category = Category::slug($slug)) {
		return Response::error(404);
	}

	$template = $posts_page->template ?: 'posts';

	Registry::set('page', $posts_page);

	Registry::set('page_offset', $page);

	Registry::set('post_category', $category);

	return new Template($template);
});

/*
	View articles
*/
Route::get($posts_page->slug . '/(:any)', function($slug) {
	if( ! $post = Post::slug($slug)) {
		return Response::error(404);
	}

	$template = $post->template ?: 'article';

	Registry::set('article', $post);

	return new Template($template);
});

// add comments
Route::post($posts_page->slug . '/(:any)', function($slug) use($posts_page) {
	$input = Input::get_array(array('name', 'email', 'text'));

	$validator = new Validator($input);

	$validator->check('email')
		->is_email(__('comments.missing_email', 'Please enter your email address'));

	$validator->check('text')
		->is_max(3, __('comments.missing_text', 'Please enter your comment'));

	if($errors = $validator->errors()) {
		Input::flash();
		
		Notify::error($errors);

		return Response::redirect($posts_page->slug . '/' . $slug . '#comment');
	}

	$input['post'] = Post::slug($slug)->id;
	$input['date'] = date('c');
	$input['status'] = Config::get('meta.auto_published_comments') ? 'approved' : 'pending';

	Comment::create($input);

	Notify::success(__('comments.created', 'Your comment has been added.'));

	return Response::redirect($posts_page->slug . '/' . $slug . '#comment');
});

/*
	Rss feed
*/
Route::get('feeds/rss', function() {
	$rss = new Rss($title, $description, $link, $lang);

	$query = Post::where('status', '=', 'published');

	foreach($query->get() as $article) {
		$rss->item($article->title, $article->slug, $article->description, $article->date);
	}

	$xml = $rss->output();

	return Response::make($xml, 200, array('content-type' => 'application/xml'));
});

/*
	Search
*/
Route::get('search', function($search = null) {
	$page = new Page;
	$page->title = 'Search';

	Registry::set('page', $page);



	return new Template('search');
});

Route::post('search', function() {
	// search and save search ID
});

/*
	View pages
*/
Route::get('(:any)', function($slug) {
	if( ! $page = Page::slug($slug)) {
		return Response::error(404);
	}

	$template = $page->template ?: 'page';

	Registry::set('page', $page);

	return new Template($template);
});

/*
	404 catch all
*/
Route::any('*', function() {
	return Response::error(404);
});