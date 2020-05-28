<?php
get_header();
$queryArgs = [
    "taxonomy" => $get_queried_object->taxonomy,
    "term_id" => $get_queried_object->term_id
];
?>
    <main class="main backGrey">
        <?php get_template_part('/core/views/headerView');?>
	    <div class="blog">
		    <div class="blog__inner">
			    <div class="container">
                    <div class="blog__wrapper-title"><span class="blog__title"><?= single_tag_title() ?></span></div>
                        <div class="blog__grid grid" id="grid">
                            <?php fg_get_posts(0 , $queryArgs); ?>
			    	    </div>
			        </div>
                </div>
            </div>
        </div>
        <?php get_template_part('/core/views/footerView'); ?>
    </main>
<?php
get_footer();