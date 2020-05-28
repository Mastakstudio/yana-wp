<?php
get_header();

get_template_part('/core/views/headerView');
?>
				<?php if (have_posts()): while (have_posts()): the_post();?> <h1 class="text__title"><?= get_the_title()?></h1>

									<?php the_content();?>

							<? if (has_post_thumbnail()){
								$img_url = get_the_post_thumbnail_url(get_the_ID(), 'custom_thumbnail');
								echo '<img class="text__front-image" src="'.$img_url.'" alt="Background"/>';
							}?>

				<?php endwhile; endif; ?>

<?php
get_template_part('/core/views/footerView');

get_footer();