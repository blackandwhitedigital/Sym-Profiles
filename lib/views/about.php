<?php
global $Speaker;
$settings = get_option($Speaker->options['settings']);
?>
<style type="text/css">
.wrap .tlp-help h3 {
	color: #bf82b9;
	font-weight: bold;
}
</style>
<div class="wrap">
    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br/></div>
    <!-- <h2><?php _e('Donations', SPEAKER_SLUG); ?></h2> -->
    <div class="tlp-content-holder">
        <div class="tch-left-pro">


          <h3><?php _e('If you found this plugin useful, please help us develop and support the free version with a small donation here...', SPEAKER_SLUG); ?></h3>
          <p>&nbsp;</p>
            <!-- Donation Button -->
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="Y4SSNFZ3JBPC6">
                    <input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
          </form>


                <?php wp_nonce_field($Speaker->nonceText(), 'speaker_nonce'); ?>

            <!-- Donation Button -->

            <div id="response" class="updated"></div>

      </div>
        <div class="tch-right-pro">
            <div id="pro-feature" class="postbox">
                <div class="handlediv" title="Click to toggle"><br></div>
                <h3 class="hndle ui-sortable-handle"><span>Symposium Speaker Profiles Pro</span></h3>
                <div class="inside">
                    <p class="heading">Pro Features</p>
                    <ul class="pro-features">
                        <li>Integrates with <a href="http://www.blackandwhitedigital.eu/product-category/plugins/" target="_blank">Agenda Pro</a> plugin, allowing you to pull speaker information directly into agenda sessions without re-entering for every agenda/event. </li>
                        <li>Display speaker's picture <em>and organisation logo</em> (in some templates)</li>
						<li>Group speakers to only display those for a particular event</li>
                        <li>Visual Composer compatibility</li>
                        <li>Unlimited color</li>
                        <li>All fields control show/hide</li>
                        <li>Grid with margin or no margin</li>
                        <li>Social icon, color size and background color control.</li>
                        <li>Detail page with popup </li>
                    </ul><a href="http://www.blackandwhitedigital.eu/product-category/plugins/" class="button button-primary" target="_blank">Get Pro Version</a>
                </div>
            </div>
        </div>

    </div>
   
    <div class="tlp-help">
        <p style="font-weight: bold">
          <?php _e('Getting Started:', AGENDA_SLUG); ?>
        </p>
<br>
        <h3>1. Adding Speakers</h3>
        <p>Click the “Add Speaker” link in the left hand menu.  Add information and save.</p><br>
        <h3>2. Display your Speakers in a Post or Page with a Shortcode</h3>
        <p>To display your speakers you will need to add a ‘shortcode’ to the page or post in the location where you want the speakers to show.  This short code will look something like this:        </p>
        <p><code>[speaker]</code> </p>
        <p>This will give you a basic display of all the speakers you have created.  However, you can refine the shortcode using some additional options to control the final display.  This is what your shortcode may look like once you have added these settings:        </p>
        <p><code>[speaker col=”2” speaker=”4” orderby=”speaker name” order=”ASC” layout=”1”]</code>
        </p>
        <p>The shortcode contains a number of optional elements that allow you to control the appearance of the speakers section.  These options are:</p>
        <ul>
        <li><strong>col</strong> = The number of columns you want to create (eg. 1, 2, 3, 4)</li>
        <li><strong>speaker</strong> = The quantity of speaker profiles you want to display (eg. 1, 5, 13 etc)</li>
        <li><strong>orderby</strong> = Orderby (speaker name, publish-date, menu_order)</li>
        <li><strong>ordr</strong> = ASC, DESC </li>
        <li><strong>layout</strong> = the layout template you want to use.  By default you can choose from  “1”, “2”, “3” and “sortable”
<ul>
          <li>1 is a portrait type display with pictures at the top</li>
            <li>2 is a landscape display with picture in a circle</li>
            <li>3 is a landscape display with square picture</li>
            <li>sortable displays pictures only with mouse over text appearing. The order can be sorted by options selected at the top of the page.  </li>
          </ul>
        </li>
        </ul>
        <p>Options 2 and 3 also allow you to display logos, in addtition to the speaker's picture.</p>
        <p><a href="http://www.blackandwhitedigital.eu/symposium-speaker-profiles-free-template-samples/" target="_blank">You can see examples of each layout here.</a></p>
      <p>&nbsp;</p>
        <h3>3. Settings Options - changing colours, fonts, etc. in your live template</h3>
        <p>Once you have selected a template design you like and include this in the short code (above) you can tweak almost every aspect of this to fit your event's branding and color scheme.</p>
      <p>On the ‘Settings’ tab in the left hand menu you can change the appearance of many elements of the speaker profiles.</p>  
        <ul>
        <li><strong>Primary Color:</strong> Select from palette or imput a hex value.</li>
        <li><strong>Square/Rounded Image:</strong> Set a percentage eg 10% </li>
        <li><strong>Image Size:</strong> Imput pixel size required eg: 200 - note that in some templates the number of columns required may mean this setting is disregarded.</li> 
        <li><strong>Image Border:</strong> You can set the line type, pixel width and color - eg “Solid 1px grey” </li>
        <li><strong>Full Bio Button:</strong> Set the background color for the button</li>
        <li><strong>Text Element Options:</strong> (Speaker Name, Role, Organisation, Description)
          <ul>
            <li><strong>Text Color:</strong> Select a color</li>
            <li><strong>Text Size: </strong>(eg. “12pt”) </li>
            <li><strong>Text Alignment: </strong>(eg. “left”, “right”, “center”, “none”)</li>
            <li><strong>Text Style:</strong> (eg. “bold”, “italic”, “underline”)</li>
            <li><strong>Show or hide text:</strong> toggle between the “show” and “hide” options for each element.</li>
          </ul>
        </li>
        <li><strong>Slug:</strong> Default is &quot;speaker&quot; - used in the shortcode</li>
        <li><strong>Link to Detail Page:</strong> Enable links to full page biographical details from some templates </li>
        <li><strong>Custom CSS:</strong> Add CSS part with the classname you want.</li>
        <li><strong>Save changes:</strong> Don’t forget!</li>
        </ul>
    </div>
    
</div>