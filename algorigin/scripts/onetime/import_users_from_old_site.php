<?php

ini_set( 'max_execution_time', '0' );

if ( php_sapi_name() !== 'cli' ) {
    echo 'not cli';
    die();
}

require_once( __DIR__ . "/../../../../../wp-load.php" );

$expdb = expdbInit();

$users = $expdb->get_results("
    SELECT u.* FROM algo_users as u, algo_usermeta as um
    WHERE u.ID = um.user_id
    AND um.meta_key = 'algo_capabilities'
    AND um.meta_value LIKE '%administrator%' 
");

global $wpdb;

foreach ( $users as $user ) {

    if ( $user->user_email !== 'sa4emka@gmail.com' ) {
    //    continue;
    }

    $exists_user = get_user_by( 'email', $user->user_email );

    if ( ! empty( $exists_user ) ) {
        continue;
    }

    $user_data = $expdb->get_results("
        SELECT * FROM algo_usermeta
        WHERE user_id = {$user->ID}
    ");

    $nickname = '';
    $first_name = '';
    $last_name = '';

    foreach ( $user_data as $ud ) {
        if ( $ud->meta_key === 'nickname' ) {
            $nickname = $ud->meta_value;
        }

        if ( $ud->meta_key === 'first_name' ) {
            $first_name = $ud->meta_value;
        }

        if ( $ud->meta_key === 'last_name' ) {
            $last_name = $ud->meta_value;
        }
    }

    $random_password = wp_generate_password( $length = 12, $special_chars = true, $extra_special_chars = false );

    $reg_data = [
        'user_login' => $user->user_login,
        'user_nicename' => $user->user_nicename,
        'display_name' => $user->display_name,
        'user_pass' => $random_password,
        'user_email' => $user->user_email,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'role' => 'administrator'
    ];

    if ( ! empty( $nickname ) ) {
        $reg_data['nickname'] = $nickname;
    }

    $new_user_id = wp_insert_user( $reg_data );

    if ( is_wp_error( $new_user_id ) ) {
        error_log('alarma!!!');
        throw new \Exception( $new_user_id->get_error_message() );
    }

    $wpdb->query(
        $wpdb->prepare(
            "
                    UPDATE {$wpdb->prefix}users
                    SET user_pass=%s
                    WHERE ID=%d
                ",
            $user->user_pass,
            $new_user_id
        )
    );

 //   break;
}

function expdbInit()
{
    $expdb = new \wpdb( 'bibimufy_live', 'ipTcKfsgyDoC48', 'bibimufy_live', 'localhost' );
    return $expdb;
}
