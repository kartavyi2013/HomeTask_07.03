<?php the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-meta">
						<?php
							printf( __( 'Опубликовано %1$s', 'hometask' ),
								sprintf( '<span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
									esc_attr( get_the_time() ),
									get_the_date()
								)
							);

							// Let's make sure we have a post parent for this image before we try and print a link to it
							if ( ! empty( $post->post_parent ) ) :
									printf( __( ' в %1$s', 'hometask' ),
										sprintf( '<a href="%1$s" title="%2$s" rel="gallery">%3$s</a>',
											get_permalink( $post->post_parent ),
											esc_attr( sprintf( __( 'Вернуться к %s', 'hometask' ), get_the_title( $post->post_parent ) ) ),
											get_the_title( $post->post_parent )
										)
									);
							endif; // end the check for the post parent

							echo ' <span class="meta-sep">|</span> ';

							$metadata = wp_get_attachment_metadata();
							printf( __( 'Размер полного изображения в пикселях: %s', 'hometask' ),
								sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
									wp_get_attachment_url(),
									esc_attr( __( 'Ссылка на полное изображение', 'hometask' ) ),
									$metadata['width'],
									$metadata['height']
								)
							);

							edit_post_link( __( 'Править', 'hometask' ), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>' );
						?>
					</div><!-- .entry-meta -->

					<div id="image-navigation">
						<span class="previous-image"><?php previous_image_link( false, __( '&larr; Предыдущее изображение' , 'hometask' ) ); ?></span>
						<span class="next-image"><?php next_image_link( false, __( 'Следующее изображение &rarr;' , 'hometask' ) ); ?></span>
					</div><!-- #image-navigation -->

					<h2 class="entry-title"><?php the_title(); ?></h2>

					<div class="entry entry-content">
						<div class="entry-attachment">
							<?php
								$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
								foreach ( $attachments as $k => $attachment ) {
									if ( $attachment->ID == $post->ID )
										break;
								}
								$k++;
								// If there is more than 1 image attachment in a gallery
								if ( count( $attachments ) > 1 ) {
									if ( isset( $attachments[ $k ] ) )
										// get the URL of the next image attachment
										$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
									else
										// or get the URL of the first image attachment
										$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
								} else {
									// or, if there's only 1 image attachment, get the URL of the image
									$next_attachment_url = wp_get_attachment_url();
								}
							?>

							<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachment_size = apply_filters( 'hometask_attachment_size', 900 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
						?></a></p>

						</div><!-- .entry-attachment -->
						<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

						<?php the_content( __( 'Читать полностью <span class="meta-nav">&rarr;</span>', 'hometask' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Страницы:', 'hometask' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php comments_template(); ?>
