<?php
$main_cat_id = carbon_get_theme_option(PREFIX .'main_category_id' );
/**@var WP_Term $main_cat*/
$main_cat = get_term_by( 'id', $main_cat_id, 'product_cat' );

$query_args = [
    'posts_per_page' => 5,
    'status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'asc',
];
if (isset($main_cat_id) && !empty($main_cat_id)){
    $query_args["category"] = [$main_cat->name];
}
$products = wc_get_products( $query_args );

//var_dump($products);

$learn_more_card_title =carbon_get_post_meta(get_the_ID(),'learn_more_card_title');
$learn_more_card_img_id =carbon_get_post_meta(get_the_ID(),'learn_more_card_img_id');
if (isset($learn_more_card_img_id) && !empty($learn_more_card_img_id) ){
    $card_img = wp_get_attachment_image_url( $learn_more_card_img_id, 'full');
}

if (count($products) > 0) :?>
<div class="product-main">
	<div class="product-main__inner">
		<div class="product-main__wrapper">
			<div class="product-main__close">
			</div>
			<div class="container">
                <div class="product-main__title-container">
                    <img class="product-main__title" src="/wp-content/themes/FalconGlen/src/icons/product-main.8e972a.png" alt="Background" title=""/>
                    <div class="product-main__cart-content-change-text">
<!--                        <div class="product-main__cart-content-currency">--><?//= fg_currency_selector() ?><!--</div>-->
                        <?php WeightConverter::weightToggleView('product-main');?>
                    </div>
                </div>
			</div>
			<div class="product-main__list">
				<?php if (count($products) > 0){
                    foreach ($products as $product){
                        homePageProductView($product);
                    }
                }
                $last_item = carbon_get_post_meta(get_the_ID(),PREFIX .'products_link_select' )[0];?>
                <div class="product-main__item">
                    <div class="product-main__item-image" style="background-image:url(<?=  $card_img  ?>)"></div>
                    <span class="product-main__item-titile">
                       <?= $learn_more_card_title?>
                    </span>
                    <?php
                    if(isset($last_item) && !empty($last_item)) {
                        if ($last_item["_type"] === "product_category" )
                            echo  '<a class="product-main__item-link" href="'.get_term_link($last_item["link"]).'">Learn more</a>';
                        elseif($last_item["_type"] === "product" || $last_item["_type"] === "page" )
                            echo  '<a class="product-main__item-link" href="'.get_permalink($last_item["link"]).'">Learn more</a>';
                        elseif($last_item["_type"] === "custom_link")
                            echo  '<a class="product-main__item-link" href="'.esc_url($last_item["link"]).'">Learn more</a>';
                    }?>
                </div>
			</div>
		</div>
	</div>
</div>
<?php endif;