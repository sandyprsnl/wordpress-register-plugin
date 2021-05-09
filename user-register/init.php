<?php

class Init
{
    public static function register(){
            new self();
            
    }
    public function __construct()
    {
        $this->loadsubmenu()->loadAjax();

        add_action('admin_enqueue_scripts', array($this,'loadScripts'));
        add_action('wp_enqueue_scripts', array($this,'loadfrondEndScripts'));
        add_filter( 'wp_authenticate_user', array($this,'Check_user_Activate_Status'), 10, 3 );
        add_shortcode('register',array( $this,'loadRegisterView'));
    }
    
    public function loadRegisterView(){
        require_once PLUGINPATH.'views/register.php';
    }
    private function loadsubmenu(){
        require_once PLUGINPATH.'submenus/submenus.php';
        return $this;
    }
    public function loadScripts(){
        wp_enqueue_script('scrip',PLUGINURL.'assets/js/script.js',array(),1.0,true);


    }
    public function loadfrondEndScripts(){
        wp_enqueue_script('jquery-js',PLUGINURL.'assets/js/jquery.js',array(),1.0,true);
        wp_enqueue_script('frontscript',PLUGINURL.'assets/js/front.script.js',array('jquery-js'),1.0,true);
        wp_localize_script(
            'frontscript',
            'ajaxobj',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
            ),
        );

    }
    public function Check_user_Activate_Status($user, $password){
        $user_meta=get_userdata($user->id);
        $user_roles=$user_meta->roles;
        // Check if the role you're interested in, is present in the array.
        if ( in_array( 'administrator', $user_roles, true ) ) {
            $user;
        }
        else{
            if($user->user_status==False)
            {
               remove_action('authenticate', 'wp_authenticate_username_password', 20);
               $user = new WP_Error( 'denied', __("<strong>ERROR</strong>: You are not activate by admin.") );
           }
        }
       
   
       return $user;
    }
    public function loadAjax(){
        require_once PLUGINPATH.'ajax/register-ajax.php';

        return $this;
    }
    
}

