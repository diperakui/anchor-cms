<?php echo $header; ?>

<h1><?php echo __('pages.editing', 'Editing'); ?> &ldquo;<?php echo Str::truncate($page->name, 4); ?>&rdquo;</h1>

<?php echo $messages; ?>

<section class="content">

	<form method="post" action="<?php echo url('pages/edit/' . $page->id); ?>" novalidate>

<<<<<<< HEAD:system/admin/theme/pages/add.php
		<input name="token" type="hidden" value="<?php echo Csrf::token(); ?>">

		<fieldset>
			<p>
				<label for="name"><?php echo __('pages.name', 'Name'); ?>:</label>
				<input id="name" name="name" value="<?php echo Input::post('name'); ?>">
=======
		<input name="token" type="hidden" value="<?php echo $token; ?>">

		<fieldset class="split">
			<p>
				<label for="name"><?php echo __('pages.name', 'Name'); ?>:</label>
				<input id="name" name="name" value="<?php echo Input::old('name', $page->name); ?>">
>>>>>>> upstream/dev:anchor/views/pages/edit.php

				<em><?php echo __('pages.name_explain', 'The name of your page. This gets shown in the navigation.'); ?></em>
			</p>

			<p>
				<label><?php echo __('pages.title', 'Title'); ?>:</label>
<<<<<<< HEAD:system/admin/theme/pages/add.php
				<input id="title" name="title" value="<?php echo Input::post('title'); ?>">
=======
				<input id="title" name="title" value="<?php echo Input::old('title', $page->title); ?>">
>>>>>>> upstream/dev:anchor/views/pages/edit.php

				<em><?php echo __('pages.title_explain', 'The title of your page, which gets shown in the <code>&lt;title&gt;</code>.'); ?></em>
			</p>

			<p>
				<label for="slug"><?php echo __('pages.slug', 'Slug'); ?>:</label>
<<<<<<< HEAD:system/admin/theme/pages/add.php
				<input id="slug" autocomplete="off" name="slug" value="<?php echo Input::post('slug'); ?>">
=======
				<input id="slug" autocomplete="off" name="slug" value="<?php echo Input::old('slug', $page->slug); ?>">
>>>>>>> upstream/dev:anchor/views/pages/edit.php

				<em><?php echo __('pages.slug_explain', 'The slug for your post (<code>/<span id="output">slug</span></code>).'); ?></em>
			</p>

			<p>
				<label for="content"><?php echo __('pages.content', 'Content'); ?>:</label>
<<<<<<< HEAD:system/admin/theme/pages/add.php
				<textarea id="content" name="content"><?php echo Html::encode(Input::post('content')); ?></textarea>

				<em><?php echo __('pages.content_explain', 'Your page\'s content. Accepts valid HTML.'); ?></em>
=======
				<textarea id="content" name="content"><?php echo Input::old('content', $page->content); ?></textarea>

				<em><?php echo __('pages.content_explain', 'Your page\'s content. Uses Markdown.'); ?></em>
>>>>>>> upstream/dev:anchor/views/pages/edit.php
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
			<button name="delete" type="submit"><?php echo __('pages.delete', 'Delete'); ?></button>
			<?php endif; ?>

			<a href="<?php echo url('pages'); ?>"><?php echo __('pages.return_pages', 'Return to pages'); ?></a>
		</p>
	</form>

</section>

<?php echo $footer; ?>
