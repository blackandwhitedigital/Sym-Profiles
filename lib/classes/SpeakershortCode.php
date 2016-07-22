 <?php

if(!class_exists('SpeakershortCode')):

	/**
	*
	*/
	class SpeakershortCode
	{

		function __construct()
		{
			add_shortcode( 'speaker', array( $this, 'speaker_shortcode' ) );
			add_action( 'wp_enqueue_scripts', array($this, 'fancybox_speaker') );

		}

		function speaker_shortcode($atts , $content = ""){

			$col_A = array(1,2,3,4,6);

			global $Speaker;
			$atts = shortcode_atts( array(
					'speaker' => 4,
					'col' => 3,
					'orderby' => 'date',
					'order'	=> 'DESC',
					'layout'	=> 1
				), $atts, 'speaker' );

			if(!in_array($atts['col'], $col_A)){
				$atts['col'] = 3;
			}
			if(!in_array($atts['layout'], array(1,2,3,'isotope'))){
				$atts['layout'] = 1;
			}

			$html = null;

			$args = array(
					'post_type' => 'speaker',
					'post_status'=> 'publish',
					'posts_per_page' => $atts['speaker'],
					'orderby' => $atts['orderby'],
					'order'   => $atts['order']
				);


			$speakerQuery = new WP_Query( $args );

			   if ( $speakerQuery->have_posts() ) {
			   		$html .= '<div class="container-fluid tlp-team">';
				   if($atts['layout'] == 'isotope') {
					   $html .= '<div class="button-group sort-by-button-group">
									<button data-sort-by="original-order" class="selected">Default</button>
									<button data-sort-by="name">Name</button>
									<button data-sort-by="designation">Job Title</button>
									<button data-sort-by="organization">Organization</button>
								  </div>';
					   $html .= '<div class="tlp-team-isotope">';
					   $html .= "<div class='isotop-stuct'>";
				   }
				   if($atts['layout'] != 'isotope') {
					   $html .= '<div class="row layout' . $atts['layout'] . '">';
					   $html .= '<div class="layout-stuct' . $atts['layout'] . '">';
				   }
				    while ($speakerQuery->have_posts()) : $speakerQuery->the_post();
				    		$ID =  get_the_ID();
				      		$title = get_the_title();
				      		$pLink = get_permalink();
				      		$short_bio = get_post_meta( get_the_ID(), 'short_bio', true );
				      		$designation = get_post_meta( get_the_ID(), 'designation', true );
				      		$organisation = get_post_meta( get_the_ID(), 'organisation', true );

				      		$logo = get_post_meta( get_the_ID(), 'meta-image', true );


				      		if (has_post_thumbnail()){
				      			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $Speaker->options['feature_img_size']);
				      			$imgSrc = $image[0];
				      		}else{
								$imgSrc = $Speaker->assetsUrl .'images/demo.jpg';
				      		}

                            $grid=12/$atts['col'];

                            if($atts['col']==2){
						          $image_area="tlp-col-lg-5 tlp-col-md-5 tlp-col-sm-6 tlp-col-xs-12 ";
						          $content_area="tlp-col-lg-7 tlp-col-md-7 tlp-col-sm-6 tlp-col-xs-12 ";
						      }else{
						          $image_area="tlp-col-lg-3 tlp-col-md-3 tlp-col-sm-6 tlp-col-xs-12 ";
						          $content_area="tlp-col-lg-9 tlp-col-md-9 tlp-col-sm-6 tlp-col-xs-12 ";
						      }

				      		$sLink = unserialize(get_post_meta( get_the_ID(), 'social' , true));

							if($atts['layout'] != 'isotope') {
								$html .= "<div class='tlp-col-lg-{$grid} tlp-col-md-{$grid} tlp-col-sm-6 tlp-col-xs-12 tlp-equal-height'>";
							}
								switch ($atts['layout']) {
									case 1:
										$html .= $this->layoutOne($ID,$title, $pLink, $imgSrc, $designation,$organisation, $short_bio, $sLink);
									break;

									case 2:
										$html .= $this->layoutTwo($ID,$title, $pLink, $imgSrc, $designation, $organisation,$logo,$short_bio, $sLink,$image_area,$content_area);
									break;

									case 3:
										$html .= $this->layoutThree($ID,$title, $pLink, $imgSrc, $designation,$organisation, $logo,$short_bio, $sLink,$image_area,$content_area);
									break;

									case 'isotope':
										$html .= $this->layoutIsotope($title, $pLink, $imgSrc, $designation,$organisation,$grid);
									break;

									default:
										# code...
									break;
								}
							if($atts['layout'] != 'isotope') {
								$html .= '</div>'; //end col

							}

				      endwhile;
				   if($atts['layout'] != 'isotope') {
					   $html .= '</div>'; // End row
					   $html .= '</div>'; //end row

				   }
				       wp_reset_postdata();
				     // end row
				   if($atts['layout'] == 'isotope') {
					   $html .= '</div>'; // end tlp-team-isotope
					   $html .= '</div>';
				   }
				   $html .= '</div>'; // end container
			   }else{
			   	$html .= "<p>".__('No speaker found',SPEAKER_SLUG)."</p>";
			   }
			return $html;
		}

		function layoutOne($ID,$title, $pLink, $imgSrc, $designation,$organisation, $short_bio, $sLink){
			global $Speaker;
			$settings = get_option($Speaker->options['settings']);
			$html = null;
			$html .= '<div class="single-team-area">';
			  	$html .='<div class="imageborder"><img class="img-responsive" src="'.$imgSrc.'" alt="'.$title.'"/></div>';
			  		$html .= '<div class="tlp-content">';
					if($settings['link_detail_page'] == 'no') {
						$html .= '<h3 class="name text-color heading-color">'. $title . '</h3>';
					}else{
						
					$html .= '<div class="body"><div class= "block"><h3 class="name text-color heading-color"><a title="' . $title . '"  class="modal-popup" href="'. $pLink.'">' . $title . '</a></h3></div>';
					}
					if($designation){
						$html .= '<div class="designation setting-org">'.$designation.'</div>';
					}
					if($organisation){
						$html .= '<div class="organisation setting-org">'.$organisation.'</div>';
					}
					if($speaker_event){
						$html .= '<div class="designation setting-org"><a href="' . $speakerevent_link . '" class ="text-color">'.$speaker_event.'</a></div>';
					}
				
	                $html .= '</div></div>';
	                $html .= '<div class="short-bio text-color">';
	    				if($short_bio){
						   	$shortexcerpt = wp_trim_words( $short_bio, $num_words = 20, $more = '<button  class="readmore_text text-color" onclick="fadeintext('.$ID.')">&nbsp...read more</button>' );
						   	$html .= '<p class="setting_desc" id="shortdesc'.$ID.'">' . $shortexcerpt . '</p>';
						   	
						   	}
						   	$html .= '<p class="setting_desc desc" id="fulldesc'.$ID.'"><a class="readmore_text" onclick="fadeouttext('.$ID.')">' . $short_bio . '</a></p>';
						if (apply_filters('the_content',get_the_content())){
						   	$html .= '<p class="full-bio"><a href="'. $pLink.'" class="full_biolink">Click for full biography</a></p>';
						}
					$html .= '</div>';
        			$html .= '<div class="tpl-social">';
        			if($sLink){
        				foreach ($sLink as $id => $link) {
        						$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
        				}
        			}
        			$html .= '</div>';
        	$html .= '</div>';
			return $html;
		}
		function layoutTwo($ID,$title, $pLink, $imgSrc, $designation,$organisation,$logo, $short_bio, $sLink, $image_area,$content_area){
			global $Speaker;
			$settings = get_option($Speaker->options['settings']);
			$html = null;
				$html .='<div class="single-team-area round-img">';
					$html .='<div class="'. $image_area.'">';
						$html .='<div class="imagebordertwo"><img class="img-lay2 " src="'.$imgSrc.'" alt="'.$title.'"/></div>';
					$html .= '</div>';

					$html .='<div class="'. $content_area.'">';
					$html .='<span class="leftcontenttwo">';
					if($settings['link_detail_page'] == 'no') {
						$html .= '<h3 class="tlp-title heading-color">'.$title.'</h3>';
					}else{
                        $html .= '<h3 class="tlp-title heading-color"><a title="'.$title.'" href="'.$pLink.'">'.$title.'</a></h3>';
					}
					$html .='<div class="designation setting-org">'.$designation.'</div>';
					$html .='<div class="organisation setting-org">'.$organisation.'</div>';
						if($speaker_event){
							$html .= '<div class="designation text-color"><a href="' . $speakerevent_link . '" class ="text-color">'.$speaker_event.'</a></div>';
						}
					$html .='</span><span class="rightcontenttwo '. $image_area.'">';
					if($logo){
		                $html .= '<img src= '.$logo.' />';
		            }
		            $html .='</span>';
					$html .='<div class="short-bio text-color">';
						if($short_bio){
						   
						   	$shortexcerpt = wp_trim_words( $short_bio, $num_words = 20, $more = '<button  class="readmore_text readtext" onclick="fadeintext('.$ID.')">&nbsp...read more</button>' );
						   	$html .= '<p class="setting_desc" id="shortdesc'.$ID.'">' . $shortexcerpt . '</p>';
						   	
						   	}
						   	$html .= '<p class="setting_desc desc" id="fulldesc'.$ID.'"><a class="readmore_text" onclick="fadeouttext('.$ID.')">' . $short_bio . '</a></br>';
						if (apply_filters('the_content',get_the_content())){
						   	$html .= '<p class="full-bio"><a href="'. $pLink.'" class="full_biolink">Click for full biography</a></p></p>';
						}
						
					$html .= '</div>';

				$html .= '</div>';
			$html .= '</div>';

			return $html;
		}
		function layoutThree($ID,$title, $pLink, $imgSrc, $designation,  $organisation,$logo,$short_bio,  $sLink,$image_area,$content_area){
			global $Speaker;
			$settings = get_option($Speaker->options['settings']);
			$html = null;
			$html .='<div class="single-team-area ">';
					$html .='<div class="'. $image_area.'">';
						$html .='<img class="img-lay2 " src="'.$imgSrc.'" alt="'.$title.'"/>';
					$html .= '</div>';

					$html .='<div class="'. $content_area.'">';
					$html .='<span class="leftcontenttwo">';
					if($settings['link_detail_page'] == 'no') {
						$html .= '<h3 class="tlp-title heading-color">'.$title.'</h3>';
					}else{
                        $html .= '<h3 class="tlp-title heading-color"><a title="'.$title.'" href="'.$pLink.'">'.$title.'</a></h3>';
					}
					$html .='<div class="designation setting-org">'.$designation.'</div>';
					$html .='<div class="organisation setting-org">'.$organisation.'</div>';
						if($speaker_event){
							$html .= '<div class="designation text-color"><a href="' . $speakerevent_link . '" class ="text-color">'.$speaker_event.'</a></div>';
						}
					$html .='</span><span class="rightcontenttwo '. $image_area.' " >';
					if($logo){
		                $html .= '<img src= '.$logo.' />';
		            }
		            $html .='</span>';
					$html .='<div class="short-bio text-color">';
						if($short_bio){
						   
						   	$shortexcerpt = wp_trim_words( $short_bio, $num_words = 20, $more = '<button  class="readmore_text readtext" onclick="fadeintext('.$ID.')">&nbsp...read more</button>' );
						   	$html .= '<p class="setting_desc" id="shortdesc'.$ID.'">' . $shortexcerpt . '</p>';
						   	
						   	}
						   	$html .= '<p class="setting_desc desc" id="fulldesc'.$ID.'"><a class="readmore_text" onclick="fadeouttext('.$ID.')">' . $short_bio . '</a>';
						if (apply_filters('the_content',get_the_content())){
						   	$html .= '<p class="full-bio"><a href="'. $pLink.'" class="full_biolink">Click for full biography</a></p></p>';
						}
					$html .= '</div>';

				$html .= '</div>';
			$html .= '</div>';
			return $html;
		}

		function layoutIsotope($title, $pLink, $imgSrc, $designation,$organisation,$grid){
			global $Speaker;
			$settings = get_option($Speaker->options['settings']);
			$html = null;
			
			$html .= "<div class='team-member tlp-col-lg-{$grid} tlp-col-md-{$grid} tlp-col-sm-6 tlp-col-xs-12 tlp-equal-height '>";
				$html .= '<div class="single-team-area">';
			  		$html .='<div class="imageborder"><img class="img-responsive" src="'.$imgSrc.'" alt="'.$title.'"/></div>';
			  		$html .= '<div class="tlp-content">';
						if($settings['link_detail_page'] == 'no') {
							$html .= '<h3 class="name heading-color">'. $title . '</h3>';
						}else{
							$html .= '<h3 class="name heading-color"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
						}
						if($designation){
							$html .= '<div class="designation setting-org">'.$designation.'</div>';
						}

						if($organisation){
							$html .= '<div class="organisation setting-org">'.$organisation.'</div>';
						}
						if (apply_filters('the_content',get_the_content())){
						   	$html .= '<p class="full-bio"><a href="'. $pLink.'" class="full_biolink">Click for full biography</a></p>';
						}
	                $html .= '</div>';
				$html .= '</div>';
        	$html .= '</div>';
        	
			return $html;
		}

		function fancybox_speaker(){
			global $Speaker;
			wp_enqueue_style( 'Speakerstyle', $Speaker->assetsUrl . 'css/speakerstyle.css' );
			
            wp_enqueue_script( 'fadein_desc', $Speaker->assetsUrl . 'js/fade_in.js', array('jquery'), '2.2.2', true);

            wp_enqueue_script( 'fadein_descinfo', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js' );
            
		}


	}

endif;
