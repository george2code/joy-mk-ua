<?php get_header(); ?>
<?php get_sidebars(); ?>
			<div id="content" class="span-13">
            	<div class="content-box clearfix">
					<?php if (have_posts()) : ?>	
						<?php while (have_posts()) : the_post(); ?>
						<?php if ( version_compare( $wp_version, '2.7', '>=' ) ) { ?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php } else { ?>
								<div id="post-<?php the_ID(); ?>" class="page post-<?php the_ID(); ?>">
							<?php } ?>
						<!--	<h1 class="title"><?php the_title(); ?></h1> -->
							<div class="entry clearfix">
								<?php the_content(__('Читать всю страницу &raquo;','cover-wp')); ?>
								<?php wp_link_pages(array('before' => '<p><strong>Страниц:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
							</div>
                            <?php if ( $user_ID ) : ?><p><?php edit_post_link(__('Изменить')); ?></p><?php endif; ?>
						</div>
				<?php endwhile; ?>
				<?php endif; ?>
               </div>
			</div>
<?php get_footer(); ?>
