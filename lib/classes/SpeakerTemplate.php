<?php

if(!class_exists('SpeakerTemplate')):

    /**
     *
     */
    class SpeakerTemplate
    {

          function __construct()
       {
           add_filter( 'template_include', array( $this, 'template_loader' ) );
           add_action( 'admin_enqueue_scripts', array($this, 'font_enqueue'));
       }

      public function font_enqueue(){
            global $Speaker;
            wp_enqueue_style( 'fontawesome', $Speaker->assetsUrl. '/css/font-awesome/css/font-awesome.css' );
            wp_enqueue_style( 'agenda-fontawsome', $Speaker->assetsUrl .'/css/font-awesome/css/font-awesome.min.css' );
           }
        public static function template_loader( $template ) {
            // $file = array('single-team.php');
            $find = array();
            $file = null;
            global $Speaker;
            if ( is_single() && get_post_type() == $Speaker->post_type ) {

                $file 	= 'single-team.php';
                $find[] = $file;
                $find[] = $Speaker->templatePath . $file;

            }

            if ( @$file ) {

                $template = locate_template( array_unique( $find ) );
                if ( ! $template ) {
                    $template = $Speaker->templatePath  . $file;
                }
            }

            return $template;
        }

    }

endif;
