<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Предыдущие публикации', 'hometask' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Следующие публикации <span class="meta-nav">&rarr;</span>', 'hometask' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Не найдено', 'hometask' ); ?></h1>
		<div class="entry entry-content">
			<p><?php _e( 'К сожалению, по вашему запросу ничего не найдено.', 'hometask' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	 ?>
<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-meta">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Постоянная ссылка: %s', 'hometask' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
				<?php edit_post_link( __( 'Править', 'hometask' ), '<span class="edit-link"> | ', '</span>' ); ?>
			</div><!-- .entry-meta -->

			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Постоянная ссылка: %s', 'hometask' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry entry-content">
				<?php the_content( __( 'Читать полностью <span class="meta-nav">&rarr;</span>', 'hometask' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Страницы:', 'hometask' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-links">
				<p class="comment-number"><?php comments_popup_link( __( 'Ваш отзыв' ), __( '1 отзыв' ), __( 'Отзывов (%)' ) ); ?></p>
				<p class="entry-categories tagged"><?php printf( __( 'Рубрики: %s' ), get_the_category_list( ', ' ) ); ?></p>
				<p class="entry-tags tagged"><?php the_tags( __( 'Метки:' ).' ', ', ', '<br />' ); ?></p>
			</div><!-- .entry-links -->

		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Предыдущие публикации', 'hometask' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Следующие публикации <span class="meta-nav">&rarr;</span>', 'hometask' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
