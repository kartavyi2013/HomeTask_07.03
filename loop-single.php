
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Предыдущая публикация', 'hometask' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Следующая публикация', 'hometask' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-meta">
						<?php the_date(); ?> &middot; <?php the_time(); ?>
						<?php edit_post_link( __( 'Править', 'hometask' ), '<span class="edit-link"> | ', '</span>' ); ?>
					</div><!-- .entry-meta -->

					<?php if ( comments_open() ) : ?>
					<div class="jump"><a href="<?php the_permalink(); ?>#comments"><?php _e( '<span class="meta-nav">&darr; </span>К комментариям', 'hometask' ); ?></a></div>
					<?php endif; ?>

					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Страницы:', 'hometask' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<div class="entry-links">
						<p class="comment-number"><?php comments_popup_link( __( 'Ваш отзыв' ), __( '1 отзыв' ), __( 'Отзывов (%)' ) ); ?></p>
						<p class="entry-categories tagged"><?php printf( __( 'Рубрика: %s' ), get_the_category_list( ', ' ) ); ?></p>
						<p class="entry-tags tagged"><?php the_tags( __( 'Метки:' ).' ', ', ', '<br />' ); ?></p>
					</div><!-- .entry-links -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Предыдущая публикация', 'hometask' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Следующая публикация', 'hometask' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>