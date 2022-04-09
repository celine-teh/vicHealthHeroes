<?php

if( isset( $_POST['option'] ) and $_POST['option'] == "custom_api_authentication_register_customer" ) {	//register the admin to miniOrange
    //validation and sanitization
    $email = '';
    $phone = '';
    $password = '';
    $confirmPassword = '';
    $fname = '';
    $lname = '';
    $company = '';
    if( custom_api_authentication_check_empty_or_null( $_POST['email'] ) || custom_api_authentication_check_empty_or_null( $_POST['password'] ) || custom_api_authentication_check_empty_or_null( $_POST['confirmPassword'] ) ) {
        update_option( 'custom_api_wp_message', 'All the fields are required. Please enter valid entries.');
        custom_api_wp_show_error_message();
        return;
    } else if( strlen( $_POST['password'] ) < 8 || strlen( $_POST['confirmPassword'] ) < 8){
        update_option( 'custom_api_wp_message', 'Choose a password with minimum length 8.');
        custom_api_wp_show_error_message();
        return;
    } else {
        $email = sanitize_email( $_POST['email'] );
        $phone = stripslashes( $_POST['phone'] );
        $password = stripslashes( $_POST['password'] );
        $confirmPassword = stripslashes( $_POST['confirmPassword'] );
        $fname = stripslashes( $_POST['fname'] );
        $lname = stripslashes( $_POST['lname' ] );
        $company = stripslashes( $_POST['company'] );
    }

    update_option( 'custom_api_authentication_admin_email', $email );
    update_option( 'custom_api_authentication_admin_phone', $phone );
    update_option( 'custom_api_authentication_admin_fname', $fname );
    update_option( 'custom_api_authentication_admin_lname', $lname );
    update_option( 'custom_api_authentication_admin_company', $company );

    if( strcmp( $password, $confirmPassword) == 0 ) {
        update_option( 'password', $password );
      
        $email = get_option('custom_api_authentication_admin_email');
        $content = json_decode( custom_api_check_customer(), true );

        if( strcasecmp( $content['status'], 'CUSTOMER_NOT_FOUND') == 0 ) {
            $response = json_decode( custom_api_create_customer(), true );
            if(strcasecmp($response['status'], 'SUCCESS') != 0) {
                update_option( 'custom_api_wp_message', 'Failed to create customer. Try again.');
            }
            custom_api_wp_show_success_message();
        } elseif(strcasecmp( $content['status'], 'SUCCESS') == 0 ) {
            update_option( 'custom_api_wp_message', 'Account already exist. Please Login.');
        } else {
            update_option( 'custom_api_wp_message', $content['status'] );
        }
        custom_api_wp_show_success_message();
        
    } else {
        update_option( 'custom_api_wp_message', 'Passwords do not match.');
        
        custom_api_wp_show_error_message();
    }
} 

if( isset( $_POST['option'] ) and $_POST['option'] == "custom_api_authentication_verify_customer" ) {	//register the admin to miniOrange
    //validation and sanitization
    $email = '';
    $password = '';
    if( custom_api_authentication_check_empty_or_null( $_POST['email'] ) || custom_api_authentication_check_empty_or_null( $_POST['password'] ) ) {
        update_option( 'custom_api_wp_message', 'All the fields are required. Please enter valid entries.');
        custom_api_wp_show_error_message();
        return;
    } else{
        $email = sanitize_email( $_POST['email'] );
        $password = stripslashes( $_POST['password'] );
    }

    update_option( 'custom_api_authentication_admin_email', $email );
    update_option( 'password', $password );

    $content = custom_api_auth_get_customer_key();
    $customerKey = json_decode( $content, true );
    if( json_last_error() == JSON_ERROR_NONE ) {
        update_option( 'custom_api_authentication_admin_customer_key', $customerKey['id'] );
        update_option( 'custom_api_authentication_admin_api_key', $customerKey['apiKey'] );
        update_option( 'custom_api_authentication_customer_token', $customerKey['token'] );
        if( isset( $customerKey['phone'] ) )
            update_option( 'custom_api_authentication_admin_phone', $customerKey['phone'] );
        delete_option( 'password' );
        update_option( 'custom_api_wp_message', 'Customer retrieved successfully');
        delete_option( 'custom_api_authentication_verify_customer' );
        custom_api_wp_show_success_message();
        
    } else {
        update_option( 'custom_api_wp_message', 'Invalid username or password. Please try again.');
        custom_api_wp_show_error_message();
    }
}

if( isset( $_POST['option'] ) and $_POST['option'] == "change_miniorange" ) {

    update_option('custom_api_authentication_verify_customer','yes');
}

function custom_api_authentication_check_empty_or_null( $value ) {
    if( ! isset( $value ) || empty( $value ) ) {
        return true;
    }
    return false;
}

function custom_api_check_customer() {
    $url 	= get_option('host_name') . "/moas/rest/customer/check-if-exists";
    $email 	= get_option("custom_api_authentication_admin_email");

    $fields = array(
        'email' 	=> $email,
    );
    $field_string = json_encode( $fields );
    $headers = array( 'Content-Type' => 'application/json', 'charset' => 'UTF - 8', 'Authorization' => 'Basic' );
    $args = array(
        'method' =>'POST',
        'body' => $field_string,
        'timeout' => '15',
        'redirection' => '5',
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => $headers,
    );
        
    $response = wp_remote_post( $url, $args );
    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo "Something went wrong: $error_message";
        exit();
    }
        
    return wp_remote_retrieve_body($response);
}

function custom_api_create_customer(){
    $url = get_option('host_name') . '/moas/rest/customer/add';
    $email 		= get_option('custom_api_authentication_admin_email');
    $phone 		= get_option('custom_api_authentication_admin_phone');
    $password 			= get_option('password');
    $firstName    		= get_option('custom_api_authentication_admin_fname');
    $lastName     		= get_option('custom_api_authentication_admin_lname');
    $company      		= get_option('custom_api_authentication_admin_company');
    
    $fields = array(
        'companyName' => $company,
        'areaOfInterest' => 'Custom Api WP',
        'firstname'	=> $firstName,
        'lastname'	=> $lastName,
        'email'		=> $email,
        'phone'		=> $phone,
        'password'	=> $password
    );
    $field_string = json_encode($fields);
    
    $headers = array( 'Content-Type' => 'application/json', 'charset' => 'UTF - 8', 'Authorization' => 'Basic' );
    $args = array(
        'method' =>'POST',
        'body' => $field_string,
        'timeout' => '15',
        'redirection' => '5',
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => $headers,

    );
    
    $response = wp_remote_post( $url, $args );
    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo "Something went wrong: $error_message";
        exit();
    }
   
    return wp_remote_retrieve_body($response);
}

function custom_api_auth_get_customer_key() {
    update_option('host_name', 'https://login.xecurify.com');
    $url 	= get_option('host_name') . "/moas/rest/customer/key";
    $email 	= get_option("custom_api_authentication_admin_email");
    
    $password = get_option("password");
    
    $fields = array(
        'email' 	=> $email,
        'password' 	=> $password
    );
    $field_string = json_encode( $fields );
    
    $headers = array( 'Content-Type' => 'application/json', 'charset' => 'UTF - 8', 'Authorization' => 'Basic' );
    $args = array(
        'method' =>'POST',
        'body' => $field_string,
        'timeout' => '15',
        'redirection' => '5',
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => $headers,

    );
    
    $response = wp_remote_post( $url, $args );
    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo "Something went wrong: $error_message";
        exit();
    }
    
    return wp_remote_retrieve_body($response);
}