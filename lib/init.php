<?php

class Speaker
{
    public $options;

	function __construct(){

        $this->options = array(
            'settings' => 'speaker_settings',
            'version'  => '1.3',
            'feature_img_size' => 'speaker-thumb',
            'installed_version' => 'speaker_installed_version'
        );

        $this->post_type = 'speaker';
        $settings = get_option($this->options['settings']);
        $this->post_type_slug = isset($settings['slug']) ? ($settings['slug'] ? sanitize_title_with_dashes($settings['slug']) : 'speaker' ) : 'speaker';
        $this->incPath       = dirname( __FILE__ );
        $this->functionsPath    = $this->incPath . '/functions/';
        $this->classesPath		= $this->incPath . '/classes/';
        $this->widgetsPath		= $this->incPath . '/widgets/';
        $this->viewsPath		= $this->incPath . '/views/';
        $this->templatePath     = $this->incPath . '/template/';

        $this->assetsUrl        = SPEAKER_PLUGIN_URL  . '/assets/';
        $this->TPLloadClass( $this->classesPath );

        $this->defaultSettings = array(
            'primary_color' => '#0367bf',
            'feature_img' => array(
                'width' => 400,
                'height'=> 400
            ),
            'slug' => 'speaker',
            'link_detail_page' => 'yes',
            'custom_css' => null
        );


        register_activation_hook(SPEAKER_PLUGIN_ACTIVE_FILE_NAME, array($this, 'activate'));
        register_deactivation_hook(SPEAKER_PLUGIN_ACTIVE_FILE_NAME, array($this, 'deactivate'));
        register_uninstall_hook(SPEAKER_PLUGIN_ACTIVE_FILE_NAME, array($this,'uninstall'));
        //var_dump(SPEAKER_PLUGIN_ACTIVE_FILE_NAME);
        

	}
    

    public function activate() {
        flush_rewrite_rules();
        $this->insertDefaultData();
    }
    
    public function uninstall(){

            global $wpdb;
            $postmeta = $wpdb->prefix."postmeta";
            $posts = $wpdb->prefix."posts";
            $speakerid=$wpdb->get_col("SELECT ID from $posts where post_type = 'speaker'");
            foreach ($speakerid as $key => $value) {
                $wpdb->query("DELETE FROM $postmeta WHERE post_id = ".$value);
            }
            $wpdb->query("DELETE FROM $posts WHERE post_type = 'speaker' ");        
    }

    public function deactivate() {
        flush_rewrite_rules();
    }


	function TPLloadClass($dir){
		if (!file_exists($dir)) return;

            $classes = array();

            foreach (scandir($dir) as $item) {
                if( preg_match( "/.php$/i" , $item ) ) {
                    require_once( $dir . $item );
                    $className = str_replace( ".php", "", $item );
                    $classes[] = new $className;
                }
            }

            if($classes){
            	foreach( $classes as $class )
            	    $this->objects[] = $class;
            }
	}

    function loadWidget($dir){
        if (!file_exists($dir)) return;
        foreach (scandir($dir) as $item) {
            if( preg_match( "/.php$/i" , $item ) ) {
                require_once( $dir . $item );
                $class = str_replace( ".php", "", $item );

                if (method_exists($class, 'register_widget')) {
                    $caller = new $class;
                    $caller->register_widget();
                }
                else {
                    register_widget($class);
                }
            }
        }
    }


	 function render( $viewName, $args = array()){
        global $Speaker;

        $viewPath = $Speaker->viewsPath . $viewName . '.php';
        if( !file_exists( $viewPath ) ) return;

        if( $args ) extract($args);
        $pageReturn = include $viewPath;
        if( $pageReturn AND $pageReturn <> 1 )
            return $pageReturn;
        if( @$html ) return $html;
    }


	/**
     * Dynamicaly call any  method from models class
     * by pluginFramework instance
     */
    function __call( $name, $args ){
        if( !is_array($this->objects) ) return;
        foreach($this->objects as $object){
            if(method_exists($object, $name)){
                
                $count = count($args);
                if($count == 0)
                    return $object->$name();
                elseif($count == 1)
                    return $object->$name($args[0]);
                elseif($count == 2)
                    return $object->$name($args[0], $args[1]);
                elseif($count == 3)
                    return $object->$name($args[0], $args[1], $args[2]);
                elseif($count == 4)
                    return $object->$name($args[0], $args[1], $args[2], $args[3]);
                elseif($count == 5)
                    return $object->$name($args[0], $args[1], $args[2], $args[3], $args[4]);
                elseif($count == 6)
                    return $object->$name($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
                elseif($count == 7)
                    return $object->$name($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
            }
        }
    }

    private function insertDefaultData()
    {
        global $Speaker;
        update_option($Speaker->options['installed_version'],$Speaker->options['version']);
        if(!get_option($Speaker->options['settings'])){
            update_option( $Speaker->options['settings'], $Speaker->defaultSettings);
        }
    }

}

global $Speaker;
if( !is_object( $Speaker ) ) $Speaker = new Speaker;


function wpb_change_title_text( $title ){
     $screen = get_current_screen();
     if  ( 'speaker' == $screen->post_type ) {
          $title = 'Speaker Name';
     }
     return $title;
}

  

add_filter( 'enter_title_here', 'wpb_change_title_text' );
// Create a helper function for easy SDK access.
function speaker() {
    global $speaker;

    if ( ! isset( $speaker ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $speaker = fs_dynamic_init( array(
            'id'                => '345',
            'slug'              => 'speaker',
            'public_key'        => 'pk_59c69aaede426964c10880897f941',
            'is_premium'        => false,
            'has_addons'        => false,
            'has_paid_plans'    => false,
            'menu'              => array(
                'slug'       => 'speaker',
                'first-path' => 'edit.php?post_type=speaker&page=gettingstarted',
                'support'    => false,
            ),
        ) );
    }

    return $speaker;
}

// Init Freemius.
speaker();