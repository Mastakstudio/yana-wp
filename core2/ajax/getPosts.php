<?php
	add_action( 'wp_ajax_morePosts', 'morePosts' );
	add_action( 'wp_ajax_nopriv_morePosts', 'morePosts' );
	
	function morePosts(){
        $offset    = empty( $_POST[ 'offset' ] ) ? '' : esc_attr( $_POST[ 'offset' ] );

        $post_query_args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'offset' => $offset
        ];

        $post_query = new WP_Query($post_query_args);
        if (count($post_query->posts) > 0){
            wp_reset_postdata();
            ob_start();
            fg_get_posts($offset);
            $response[ 'posts' ] = ob_get_clean();
            $response[ 'status' ] = 1;
        }else{
            wp_reset_postdata();
            $response[ 'posts' ] = '';
            $response[ 'text' ] = 'no more posts';
            $response[ 'status' ] = 0;
        }
		echo json_encode( $response );
		wp_die();
	}