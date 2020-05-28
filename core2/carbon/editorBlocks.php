<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_edit_blocks_settings');
function crb_edit_blocks_settings(){
	
	$signatures_labels = [
		'plural_name' => 'signatures',
		'singular_name' => 'signature',
	];
	Block::make( __( 'stylish quote' ) )
		->add_fields( [
			Field::make_textarea('content', __( 'Block Content' ) ),
			Field::make_complex('signatures', 'Signatures')
				->add_fields([ Field::make_text('text') ])
				->set_layout('tabbed-vertical')
				->set_max(2)
				->setup_labels( $signatures_labels )
		] )
		->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
			?>
				<div class="text__quotation-inner">
					<div class="text__quotation-marks">
						<img class="text__quotation-mark annotation__quotation-mark-left" src="/wp-content/themes/FalconGlen/src/icons/quotation-mark.2b800d.svg" alt="Quotation marks" title=""/>
						<img class="text__quotation-mark annotation__quotation-mark-right" src="/wp-content/themes/FalconGlen/src/icons/quotation-mark.2b800d.svg" alt="Quotation marks" title=""/>
					</div>
					<div class="text__quotation-text">
						<div class="text__quotation">
							<?php echo apply_filters( 'the_content', $fields['content'] ); ?>
						</div>
						<div class="text__quotation-inscription">
							<?php
							if ($fields['content']) {
								foreach ($fields['signatures'] as $text) {
									echo '<span>'.$text.'</span>';
								}
							} ?>
						</div>
					</div>
				</div>
				<?php
		} );
}