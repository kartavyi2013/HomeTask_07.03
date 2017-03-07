<?php

get_header(); ?>

		<div id="content-container">
			<div id="content" role="main">				

					<?php the_post(); ?>
					
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if ( is_front_page() ) { ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php } else { ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php } ?>

						<div class="entry entry-content">
							<ul>
							<?php wp_list_bookmarks(); ?>
							</ul>
							<?php edit_post_link( __( 'Править', 'hometask' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-## -->

					<?php comments_template( '', true ); ?>					

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>