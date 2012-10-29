<?php echo $header; ?>

<h1><?php echo __('pages.editing', 'Editing'); ?> &ldquo;<?php echo Str::truncate($page->name, 4); ?>&rdquo;</h1>

<?php echo $messages; ?>

<section class="content">

	<form method="post" action="<?php echo url('pages/edit/' . $page->id); ?>" novalidate>

<<<<<<< HEAD:anchor/views/pages/edit.php
		<input name="token" type="hidden" value="<?php echo $token; ?>">

		<fieldset class="split">
			<p>
				<label for="name"><?php echo __('pages.name', 'Name'); ?>:</label>
				<input id="name" name="name" value="<?php echo Input::old('name', $page->name); ?>">
=======
		<input name="token" type="hidden" value="<?php echo Csrf::token(); ?>">

		<fieldset>
			<p>
				<label for="name"><?php echo __('pages.name', 'Name'); ?>:</label>
				<input id="name" name="name" value="<?php echo Input::post('name'); ?>">
>>>>>>> 2c341dfc5d9de8c0e080fb05a7bd581eaa1a74ba:system/admin/theme/pages/add.php

				<em><?php echo __('pages.name_explain', 'The name of your page. This gets shown in the navigation.'); ?></em>
			</p>

			<p>
				<label><?php echo __('pages.title', 'Title'); ?>:</label>
<<<<<<< HEAD:anchor/views/pages/edit.php
				<input id="title" name="title" value="<?php echo Input::old('title', $page->title); ?>">
=======
				<input id="title" name="title" value="<?php echo Input::post('title'); ?>">
>>>>>>> 2c341dfc5d9de8c0e080fb05a7bd581eaa1a74ba:system/admin/theme/pages/add.php

				<em><?php echo __('pages.title_explain', 'The title of your page, which gets shown in the <code>&lt;title&gt;</code>.'); ?></em>
			</p>

			<p>
				<label for="slug"><?php echo __('pages.slug', 'Slug'); ?>:</label>
<<<<<<< HEAD:anchor/views/pages/edit.php
				<input id="slug" autocomplete="off" name="slug" value="<?php echo Input::old('slug', $page->slug); ?>">
=======
				<input id="slug" autocomplete="off" name="slug" value="<?php echo Input::post('slug'); ?>">
>>>>>>> 2c341dfc5d9de8c0e080fb05a7bd581eaa1a74ba:system/admin/theme/pages/add.php

				<em><?php echo __('pages.slug_explain', 'The slug for your post (<code>/<span id="output">slug</span></code>).'); ?></em>
			</p>

			<p>
				<label for="content"><?php echo __('pages.content', 'Content'); ?>:</label>
<<<<<<< HEAD:anchor/views/pages/edit.php
				<textarea id="content" name="content"><?php echo Input::old('content', $page->content); ?></textarea>

				<em><?php echo __('pages.content_explain', 'Your page\'s content. Uses Markdown.'); ?></em>
=======
				<textarea id="content" name="content"><?php echo Html::encode(Input::post('content')); ?></textarea>

				<em><?php echo __('pages.content_explain', 'Your page\'s content. Accepts valid HTML.'); ?></em>
>>>>>>> 2c341dfc5d9de8c0e080fb05a7bd581eaa1a74ba:system/admin/theme/pages/add.php
			</p>

			<p>
				<label for="redirect"><?php echo __('pages.redirect_option', 'This page triggers a redirect to another url'); ?>:</label>
				<?php $checked = Input::old('redirect_url', $page->redirect) ? ' checked' : ''; ?>
				<input id="redirect" type="checkbox"<?php echo $checked; ?>>
			</p>

			<p>
				<label for="redirect_url"><?php echo __('pages.redirect_url', 'Redirect Url'); ?></label>
				<input id="redirect_url" name="redirect" value="<?php echo Input::old('redirect_url', $page->redirect); ?>">
			</p>

			<p>
				<label><?php echo __('pages.status', 'Status'); ?>:</label>
				<select id="status" name="status">
					<?php foreach(array(
						'draft' => __('pages.draft', 'Draft'),
						'archived' => __('pages.archived', 'Archived'),
						'published' => __('pages.published', 'Published')
					) as $value => $status): ?>
					<?php $selected = (Input::old('status', $page->status) == $value) ? ' selected' : ''; ?>
					<option value="<?php echo $value; ?>"<?php echo $selected; ?>>
						<?php echo $status; ?>
					</option>
					<?php endforeach; ?>
				</select>

				<em><?php echo __('pages.status_explain', 'Do you want your page to be live (published), pending (draft), or hidden (archived)?'); ?></em>
			</p>
		</fieldset>

		<p class="buttons">
			<button name="save" type="submit"><?php echo __('pages.save', 'Save'); ?></button>
			<?php if(in_array($page->id, array(Config::get('metadata.home_page'), Config::get('metadata.posts_page'))) === false): ?>
			<a class="btn delete red" href="<?php echo url('pages/delete/' . $page->id); ?>"><?php echo __('pages.delete', 'Delete'); ?></a>
			<?php endif; ?>
		</p>
	</form>

</section>

<?php echo $footer; ?>
