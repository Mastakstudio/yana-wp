<?php
class ACCOUNT_AJAX
{
    /**
     * Hook in ajax handlers.
     */
    public static function init()
    {
        self::add_ajax_events();
        add_action('template_redirect', array(__CLASS__, 'do_mastak_account_ajax'), 0);
    }

    /**
     * Hook in methods - uses WordPress ajax handlers (admin-ajax).
     */
    public static function add_ajax_events() {
        $ajax_events_nopriv = [
            'login',
            'registration',
        ];

        foreach ( $ajax_events_nopriv as $ajax_event ) {
            add_action( 'wp_ajax_mastak_' . $ajax_event, array( __CLASS__, $ajax_event ) );
            add_action( 'wp_ajax_nopriv_mastak_' . $ajax_event, array( __CLASS__, $ajax_event ) );

            // WC AJAX can be used for frontend ajax requests.
            add_action( 'mastak_ajax_' . $ajax_event, array( __CLASS__, $ajax_event ) );
        }
    }

    /**
     * Send headers for WC Ajax Requests.
     *
     * @since 2.5.0
     */
    private static function mastak_ajax_headers() {
        if ( ! headers_sent() ) {
            send_origin_headers();
            send_nosniff_header();

            header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
            header( 'X-Robots-Tag: noindex' );
            status_header( 200 );
        } elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            headers_sent( $file, $line );
            trigger_error( "mastak_ajax_headers cannot set headers - headers already sent by {$file} on line {$line}", E_USER_NOTICE ); // @codingStandardsIgnoreLine
        }
    }

    /**
     * Check for WC Ajax request and fire action.
     */
    public static function do_mastak_account_ajax() {
        global $wp_query;

        if ( ! empty( $_GET['mastak_account-ajax'] ) ) {
            $wp_query->set( 'mastak_account-ajax', sanitize_text_field( wp_unslash( $_GET['mastak_account-ajax'] ) ) );
        }

        $action = $wp_query->get( 'mastak_account-ajax' );

        if ( $action ) {
            self::mastak_ajax_headers();
            $action = sanitize_text_field( $action );
            do_action( 'mastak_ajax_' . $action );
            wp_die();
        }
    }

    /**
     * Get WC Ajax Endpoint.
     *
     * @param string $request Optional.
     *
     * @return string
     */
    public static function get_endpoint( $request = '' ) {
        return esc_url_raw(
            add_query_arg( 'mastak_account-ajax', $request ));
    }

    /**
     * AJAX login.
     */
    public static function login() {
        $return = [];
        if (empty($_POST['username']) || empty($_POST['username']) || empty($_POST['username']) || empty($_POST['username']))
            wp_send_json_error();

        $user_data = [
        	'user_login' => $_POST['username'],
	        'user_password' => $_POST['password'],
	        'remember' => !empty($_POST['rememberme'])
        ];

        $loginResult = wp_signon($user_data);

        if ( strtolower(get_class($loginResult)) == 'wp_user' ) {
            //User login successful
            /**@var WP_User loginResult*/
            $user = $loginResult;
            $return['result'] = true;

            $return['myAccountLink'] = get_permalink(carbon_get_theme_option( TO_ACCOUNT_PAGE ));

        } elseif ( strtolower(get_class($loginResult)) == 'wp_error' ) {
            //User login failed
            /* @var WP_Error $loginResult */
            $return['result'] = false;
            $return['error'] = $loginResult->get_error_message();
        } else {
            //Undefined Error
            $return['result'] = false;
            $return['error'] = 'An undefined error has ocurred';
        }

        wp_send_json($return, 200);
        die();
    }

    /**
     * AJAX registration.
     */
    public static function registration() {
        $result = [];
        if( get_option('users_can_register') ){

            $regResult = register_new_user( $_POST['email'], $_POST['email']);

	        if ( is_wp_error($regResult) ) {
		        $result['result'] = false;
		        $result['error'] = $regResult->get_error_message();

		        wp_send_json($result, 200);
		        die();
	        }

            $result['result'] = true;

            if( is_multisite() )
                add_user_to_blog(get_current_blog_id(), $regResult, get_option('default_role'));

            wp_set_password($_POST['password'], $regResult);
	        update_user_meta( $regResult, 'show_admin_bar_front', 'false' );

            $user_data = ['user_login' => $_POST['email'], 'user_password' => $_POST['password'], 'remember' => !empty($_POST['rememberme'])];
            $loginResult = wp_signon($user_data);

            if ( $loginResult instanceof WP_User ) {
                /**@var WP_User loginResult*/
                $user = $loginResult;
                $result['displayName'] = $user->display_name;

            } elseif ( $loginResult instanceof WP_Error) {
                /* @var WP_Error $loginResult */
                $result['result'] = false;
                $result['error'] = $loginResult->get_error_message();
            }

            wp_send_json_success($result);
            die();

        }
        else{
            $result['result'] = false;
            $result['error'] = 'Registration has been disabled.';
        }
        wp_send_json($result, 200);
        die();
    }
}

ACCOUNT_AJAX::init();