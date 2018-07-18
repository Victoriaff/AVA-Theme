<?php
	//$header_class = 'header';
	get_header();
?>
	<div class="container single-blog">
		<div class="post">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'engine-hosting' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'engine-hosting' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'engine-hosting' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'engine-hosting' ) . '</span> <span class="nav-title">%title</span>',
				) );

			endwhile; // End of the loop.
			?>

            <!--===================== Related Post ========================-->
			<?php
			$related_posts = $eh_theme->model->post->get_related_posts(get_the_ID(), 2);

			if (!empty($related_posts->posts)) {
			//dd($related_posts);
			?>
			<div class="related-post">
				<h5><?php echo __('Related Articles', 'engine-hosting'); ?></h5>
				<ul class="animatedParent">
					<?php
					$i = 0;
					foreach ($related_posts->posts as $_post) {
					?>
					<li class="animated <?php echo !$i ? 'bounceInLeft':'bounceInRight'; ?>">
						<?php
						$thumbnail = get_the_post_thumbnail_url( $_post->ID, 'thumbnail');
						if ( $thumbnail ) { ?>
						    <a href="<?php echo get_permalink( $_post->ID ); ?>">

							<img src="<?php echo esc_attr($thumbnail); ?>" alt="<?php echo esc_attr($_post->post_title); ?>">

                            </a>
						<?php } ?>

                        <a href="<?php echo get_permalink( $_post->ID ); ?>">
						<?php echo esc_html($_post->post_title); ?>
						</a>
					</li>
					<?php
						$i++;
						}
					?>
				</ul>
			</div>
			<!--===================== End of Related Post ========================-->
			<?php } ?>

		</div><!--post-->
	</div>

<?php get_footer();
