<?php
class ACCOUNT_AJAX
{
    /**
     * Hook in ajax handlers.
     */
    public static function init()
    {
        self::add_ajax_events();
        add_action('template_redirect', array(__CLASS__, 'do_prosuhsi_account_ajax'), 0);
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
            add_action( 'wp_ajax_prosushi_' . $ajax_event, array( __CLASS__, $ajax_event ) );
            add_action( 'wp_ajax_nopriv_prosushi_' . $ajax_event, array( __CLASS__, $ajax_event ) );

            // WC AJAX can be used for frontend ajax requests.
            add_action( 'prosushi_ajax_' . $ajax_event, array( __CLASS__, $ajax_event ) );
        }
    }

    /**
     * Send headers for WC Ajax Requests.
     *
     * @since 2.5.0
     */
    private static function prosushi_ajax_headers() {
        if ( ! headers_sent() ) {
            send_origin_headers();
            send_nosniff_header();
            wc_nocache_headers();
            header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
            header( 'X-Robots-Tag: noindex' );
            status_header( 200 );
        } elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            headers_sent( $file, $line );
            trigger_error( "prosushi_ajax_headers cannot set headers - headers already sent by {$file} on line {$line}", E_USER_NOTICE ); // @codingStandardsIgnoreLine
        }
    }

    /**
     * Check for WC Ajax request and fire action.
     */
    public static function do_prosuhsi_account_ajax() {
        global $wp_query;

        if ( ! empty( $_GET['prosushi_account-ajax'] ) ) {
            $wp_query->set( 'prosushi_account-ajax', sanitize_text_field( wp_unslash( $_GET['prosushi_account-ajax'] ) ) );
        }

        $action = $wp_query->get( 'prosushi_account-ajax' );

        if ( $action ) {
            self::prosushi_ajax_headers();
            $action = sanitize_text_field( $action );
            do_action( 'prosushi_ajax_' . $action );
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
            add_query_arg( 'prosushi_account-ajax', $request ));
    }

    /**
     * AJAX login.
     */
    public static function login() {
        $return = [];
        if (empty($_POST['username']) || empty($_POST['username']) || empty($_POST['username']) || empty($_POST['username']))
            wp_send_json_error();

        $user_data = ['user_login' => $_POST['username'], 'user_password' => $_POST['password'], 'remember' => !empty($_POST['rememberme'])];

        $loginResult = wp_signon();

        if ( strtolower(get_class($loginResult)) == 'wp_user' ) {
            //User login successful
            /**@var WP_User loginResult*/
            $user = $loginResult;
            $return['result'] = true;

            $userName =  isset($user->first_name) && !empty($user->first_name) ? $user->first_name : '';
            $userName .=  isset($user->last_name) && !empty($user->last_name)? ' '. $user->last_name : '';
	        $userName =  !empty($userName)? $userName : $user->display_name;
            $displayName = !empty($userName) ? $userName :  $user->user_email;
            $return['user'] = [
                'displayName' => $displayName
                ];
            $return['myAccountLink'] = get_permalink(1);

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
        $return = [];
        if( get_option('users_can_register') ){
            $errors = register_new_user( $_POST['email'], $_POST['email']);
            if ( !is_wp_error($errors) ) {
                //Success
                $return['result'] = true;
                $return['message'] = 'Registration complete. Please check your e-mail.';
                //add user to blog if multisite
                if( is_multisite() ){
                    add_user_to_blog(get_current_blog_id(), $errors, get_option('default_role'));
                }
                wp_set_password($_POST['password'], $errors);

                $user_data = ['user_login' => $_POST['email'], 'user_password' => $_POST['password'], 'remember' => !empty($_POST['rememberme'])];

                $loginResult = wp_signon($user_data);

                if ( strtolower(get_class($loginResult)) == 'wp_user' ) {
                    //User login successful
                    /**@var WP_User loginResult*/
                    $user = $loginResult;
                    $return['result'] = true;

                    $userName =  !empty($user->first_name) ? $user->first_name : '';
                    $userName .=  !empty($user->last_name) ? ' '. $user->last_name : '';
                    $displayName = !empty($userName) ? $userName : $user->user_email;
                    $return['user'] = [
                        'displayName' => $displayName
                    ];
                    $return['myAccountLink'] = get_permalink(wc_get_page_id("myaccount"));

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

                wp_send_json_success($return);
                die();

            }else{
                //Something's wrong
                $return['result'] = false;
                $return['error'] = $errors->get_error_message();
            }
            $return['action'] = 'register';
        }else{
            $return['result'] = false;
            $return['error'] = 'Registration has been disabled.';
        }
        wp_send_json($return, 200);
        die();
    }
}

ACCOUNT_AJAX::init();