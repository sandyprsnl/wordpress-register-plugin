<?php

class register_ajax
{
    private $wpdb;
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        add_action('wp_ajax_ActivateUser', array($this, "ActivateUser"));
        add_action('wp_ajax_nopriv_ActivateUser', array($this, "ActivateUser"));
        add_action('wp_ajax_RegisterUser', array($this, "RegisterUser"));
        add_action('wp_ajax_nopriv_RegisterUser', array($this, "RegisterUser"));
    }
    public function ActivateUser()
    {
        if (isset($_POST)) {
            $id = $_POST['id'];
            $result = $this->wpdb->get_results(" UPDATE wp_users SET user_status =1  WHERE ID=" . $id);
            wp_send_json_success('User  Activated');
        } else {
            wp_send_json_error('User not Activated');
        }
    }
    public function RegisterUser()
    {
        if (isset($_POST)) {
            if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
                wp_send_json_error( 'Required form field is missing');
            } elseif (4 > strlen($_POST['username'])) {
                wp_send_json_error( 'Username too short. At least 4 characters is required');
            } elseif (username_exists($_POST['username'])) {

                wp_send_json_error(' that username already exists!');
            } elseif (!validate_username($_POST['username'])) {
                wp_send_json_error('Sorry, the username you entered is not valid');
            }
            else{
                // $this->registration($_POST); 
                if(isset($_FILES['profile']) && !empty($_FILES['profile'])){
                    if($_FILES['profile']['error']==0){
                        $img= $this-> Uploadimage($_FILES);
                    }
                  
                }
                else{
                    $img='';
                }
                $_POST['profile']=$img;
                $this->registration($_POST);

            }
        } else {
            wp_send_json_error('User not Activated');
        }
    }
    public function Uploadimage($file)
    {
        $error = $file["profile"]["error"];
        if ($error == 0) {
            $name = str_replace(' ',"_",$_FILES["profile"]["name"]) ;
            // $ext = pathinfo($name, PATHINFO_EXTENSION);
            $upload= wp_upload_bits($name, null, file_get_contents($file["profile"]["tmp_name"]));
            if ($upload)
             {
               return $upload['url'];
            } else {
                wp_send_json_error('Sorry,image not upload'); 
            }
        }
        else{
            wp_send_json_error('Sorry,image not upload'); 
        }
    }
    public function registration($userData) {
            $userdata = array(
            'user_login'    =>   $userData['username'],
            'user_email'    =>   $userData['email'],
            'user_pass'     =>   $userData['password'],
            'first_name'    =>   $userData['fname'],
            'last_name'     =>   $userData['lname'],
            );
            $userid = wp_insert_user( $userdata );
            if ( is_wp_error( $userid ) ) {
                $error = $userid->get_error_message();
                wp_send_json_error($error );
            }
            else{
                add_user_meta( $userid, 'dob', $userData['dob'] );
                add_user_meta( $userid, 'mobile', $userData['phone'] );
                add_user_meta( $userid, 'profile-img',$userData['profile']  );
                wp_send_json_success( 'You Registered successfully, wait until admin verifies your account' );

            }
    }
}
new register_ajax();
