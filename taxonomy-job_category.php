<?php get_header( 'leftsidebar' ); ?>

<div id="main-content">
	<div class="container">

		<div id="content-area" class="clearfix">
			<?php get_sidebar(); ?>
			<div id="left-area">

		<?php
			if ( have_posts() ) :
				$terms = get_the_terms( $post->ID, 'job_category' );
				if ( !empty( $terms ) ){
				    // get the first term
				    $term = array_shift( $terms );
				}
		?>
				<div class="et_post_meta_wrapper job_category">
					<h1><?php echo $term->name; ?> Job Openings</h1>

					<div class="taxonomy-description">
						<p><?php echo $term->description; ?></p>
					</div>
				</div>

				<?php
						while ( have_posts() ) : the_post();
							$post_format = et_pb_post_format(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

						<?php
							$thumb = '';

							$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

							$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
							$classtext = 'et_pb_post_main_image';
							$titletext = get_the_title();
							$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
							$thumb = $thumbnail["thumb"];

							et_divi_post_format_content();

							if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
								if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
									printf(
										'<div class="et_main_video_container">
											%1$s
										</div>',
										$first_video
									);
								elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
									<a href="<?php the_permalink(); ?>">
										<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
									</a>
							<?php
								elseif ( 'gallery' === $post_format ) :
									et_pb_gallery_images();
								endif;
							} ?>

						<?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) : ?>
							<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) : ?>
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php endif; ?>

							<?php
								//et_divi_post_meta();

								if ( 'on' !== et_get_option( 'divi_blog_style', 'false' ) || ( is_search() && ( 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) ) ) ) {
									truncate_post( 270 );
								} else {
									the_content();
								}
							?>
							<div class="view-job"><a href="<?php the_permalink(); ?>" class="view-job-btn">Learn More</a></div>
						<?php endif; ?>

							</article> <!-- .et_pb_post -->
					<?php
							endwhile;

							if ( function_exists( 'wp_pagenavi' ) )
								wp_pagenavi();
							else
								get_template_part( 'includes/navigation', 'index' );
						else :
							?>
							<div class="no-jobs"><p>There are no job openings at this time.</p></div>
							<?php
						endif;
					?>
			</div> <!-- #left-area -->
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->
<?php get_footer(); ?>
</div> <!-- #main-content -->
<?php get_footer(); ?>