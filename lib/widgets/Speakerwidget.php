<?php

if(!class_exists('Speakerwidget')):

    class Speakerwidget extends WP_Widget
    {

        /**
         * Speaker widget setup
         */
        function Speakerwidget() {

            $widget_ops = array( 'classname' => 'widget_Speaker', 'description' => __('Speakers', SPEAKER_SLUG) );

            parent::__construct( 'widget_Speaker', __('Speaker', SPEAKER_SLUG), $widget_ops);

        }

        /**
         * display the widgets on the screen.
         */

        function widget( $args, $instance ) {

            extract( $args );
            global $Speaker;

            @$title = ($instance['title'] ? $instance['title'] : __('Speaker', SPEAKER_SLUG));
            @$speaker = ($instance['speaker'] ? (int)$instance['speaker'] : 2);
            @$layout = ($instance['layout'] ? (int)$instance['layout'] : 'grid');


            echo $before_widget;
            if ( ! empty( $instance['title'] ) ) {

                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }
                    $args = array(
                        'post_type' => 'speaker',
                        'post_status'=> 'publish',
                        'posts_per_page' => $speaker,
                        'orderby' => 'date',
                        'order'   => 'DESC',
                    );
                    $speakerQ = new WP_Query( $args );
                    $html = null;
                    $html .= '<div class="container-fluid tlp-team">';
                    $html .= "<div class='row'>";
                    $html .= "<div class='service-list-wrapper'>";
                    if ( $speakerQ->have_posts() ) {
                            while ($speakerQ->have_posts()) : $speakerQ->the_post();

                                  if (has_post_thumbnail()){
                                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $Speaker->options['feature_img_size'] );
                                      $img = $image[0];
                                  }else{
                                    $img = $Speaker->assetsUrl .'images/demo.jpg';
                                  }
                              $bio = get_post_meta( get_the_ID(), 'short_bio', true );
                              $designation = get_post_meta( get_the_ID(), 'designation', true );
                              $organisation = get_post_meta( get_the_ID(), 'organisation', true);
                              $tel = get_post_meta( get_the_ID(), 'telephone', true );
                              $loc = get_post_meta( get_the_ID(), 'location', true );
                              $email = get_post_meta( get_the_ID(), 'email', true );
                              $url = get_post_meta( get_the_ID(), 'web_url', true );
                              $logo = get_post_meta( get_the_ID(), 'meta-image', true );
                              $grid=12/$speaker;
                                $html .= "<div class='tlp-col-lg-12 tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12 tlp-equal-height'>";
                                $html .= '<div class="single-team-area">';
                                $html .="<div class='tlp-col-lg-3 tlp-col-md-3 tlp-col-sm-3 tlp-col-xs-12 profile-pic'><img src='$img' /></div>
                                        <div class='tlp-col-lg-7 tlp-col-md-7 tlp-col-sm-7 tlp-col-xs-12'>
                                        <h3 class='widget-heading'><a href='".get_the_permalink()."'><span>".get_the_title();


                                    if($designation){
                                        $html .="</span><span>&nbsp$designation</span>";
                                    }
                                //$html .= "";
                                //$html .= '<div class="organisation">';
                                    if($organisation){
                                        $html .="<span>&nbsp$organisation</span>";
                                    }
                                $html .= "</a></h3>";
                                $html .= '<div class="short-bio">';
                                    if($bio){
                                        $html .="<div class='bio'>$bio</div>";
                                    }
                                $html .= "</div></div>";

                                 $html .= '<div class="tlp-col-lg-2 tlp-col-md-2 tlp-col-sm-2 tlp-col-xs-12 logo">';
                                 if($logo){
                                 $html .= '<img src= '.$logo.' />';
                                 }
                                 $html .= "</div>";

                            $html .="</div>";
                            $html .="</div>";
                            $html .= "<div class='tlp-col-lg-12 tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12 tlp-equal-height spkwdt'>";
                            $html .= "<div class='tlp-col-lg-3 tlp-col-md-3 tlp-col-sm-3 tlp-col-xs-12'>"; 
                              $html .= "</div>";
                              $html .= "<div class='tlp-col-lg-7 tlp-col-md-7 tlp-col-sm-7 tlp-col-xs-12 border-btm'>";
                              $html .= "</div>";
                              $html .= "<div class='tlp-col-lg-2 tlp-col-md-2 tlp-col-sm-2 tlp-col-xs-12'>";
                              $html .= "</div>";
                              $html .= "</div>";

                            endwhile;

                        wp_reset_postdata();
                    }else{
                        $html .= "<p>".__('No speaker found',SPEAKER_SLUG)."</p>";
                    }

                    $html .= "</div>";

                    $html .= "</div>";
                    $html .= "</div>";

                    echo $html;

            echo $after_widget;
        }
        function form( $instance ) {

            $defaults = array(
                'title' => '',
                'speaker' => 4
            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>
            <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', SPEAKER_SLUG); ?></label>
                <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

            <p><label for="<?php echo $this->get_field_id( 'speaker' ); ?>"><?php _e('Number of speaker to show:', SPEAKER_SLUG); ?></label>
                <input type="text" size="2" id="<?php echo $this->get_field_id('speaker'); ?>" name="<?php echo $this->get_field_name('speaker'); ?>" value="<?php echo $instance['speaker']; ?>" /></p>

         
            <?php
        }
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['speaker'] = ( ! empty( $new_instance['speaker'] ) ) ? (int)( $new_instance['speaker'] ) : '';
            $instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? (int)( $new_instance['layout'] ) : '';

            return $instance;
        }


    }


endif;
//apply only on home page
 /*   if ( is_front_page() && is_home()  ) {

    do_shortcode('[speaker col="2" speaker="4" orderby="meta_id" order="DESC" layout="3"]' );
}*/

 //echo do_shortcode('[speaker col="4" speaker="8" orderby="meta_id" order="DESC" layout="1"]');
