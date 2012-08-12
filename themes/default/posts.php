<?php theme_include('header'); ?>

		<section>

			<?php if(has_posts()): ?>

				<?php while(posts()): ?>
				<article>
					<a href="<?php echo article_url(); ?>" title="<?php echo article_title(); ?>">
						<?php echo article_title(); ?>							
					</a>

					<span class="category">Posted under 
					<a href="<?php echo article_category_url(); ?>"><?php echo article_category(); ?></a></span>

					<time datetime="<?php echo date(DATE_W3C, article_time()); ?>"><?php echo relative_time(article_time()); ?></time>
				</article>
				<?php endwhile; ?>

				<p><?php echo posts_prev(); ?> <?php echo posts_next(); ?></p>

			<?php else: ?>
				<p>Looks like you have some writing to do!</p>
			<?php endif; ?>

		</section>

		<aside>
			<ul>
			<?php while(categories()): ?>
				<li>
					<a href="<?php echo category_url(); ?>" title="<?php echo category_description(); ?>">
						<?php echo category_title(); ?>
					</a>
				</li>
			<?php endwhile; ?>
			</ul>
		</aside>

<?php theme_include('footer'); ?>