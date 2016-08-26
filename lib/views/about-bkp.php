<?php
global $Speaker;
$settings = get_option($Speaker->options['settings']);
?>


<div class="wrap">
    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br/></div>
    <!-- <h2><?php _e('Donations', SPEAKER_SLUG); ?></h2> -->
    <div class="tlp-content-holder">
        <div class="tch-left-pro">


                <h3><?php _e('Make your donations Here..!', SPEAKER_SLUG); ?></h3><br><br>
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
                <div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle ui-sortable-handle"><span>Speaker Pro</span></h3>
                <div class="inside">
                    <p class="heading">Pro Feature</p>
                    <ul class="pro-features">
                        <li>Links to Speaker Pro plugin and gives drop down or Events to show when you can hear this speaker </li>
                        <li>Visual Composer compatibility.</li>
                        <li>Unlimited color.</li>
                        <li>All fields control show/hide.</li>
                        <li>Grid with Margin or No Margin.</li>
                        <li>Social icon, color size and background color control.</li>
                        <li>Detail page with Popup </li>
                    </ul><a href="http://www.blackandwhitedigital.eu/product-category/plugins/" class="button button-primary" target="_blank">Get Pro Version</a>
                </div>
            </div>
        </div>

    </div>
   
    <div class="tlp-help">
        <p style="font-weight: bold"><?php _e('Getting Started:', AGENDA_SLUG); ?> :</p><br>
        <h3>Adding Speakers</h3>
        <p>Click the “Add Speaker” link in the left hand menu.  Add information and save.</p><br>
        <h3>Displaying your Speakers in a Post of Page</h3>
        <p>To display your speakers you will need to add a ‘shortcode’ to the page or post in the location where you want the speakers to show.  This short code will look something like this:</p>
        <code>[speaker]</code>
        <p>This will give you a basic display of all the speakers you have created.  However, you can refine the shortcode using some additional options to control the final display.  This is what your shortcode may look like once you have added these settings:</p>
        <code>[speaker col=”2” speaker=”4” orderby=”title” order=”ASC” layout=”1”]</code>
        <p>The shortcode contains a number of optional elements that allow you to control the appearance of the speakers section.  These options are:</p>
        <ul>
        <li>col = The number of columns you want to create (eg. 1, 2, 3, 4)</li>
        <li>speaker = The number of the speakers, you want to display (eg. 1, 5, 13 etc)</li>
        <li>orderby = Orderby (title , date, menu_order)</li>
        <li>ordr = ASC, DESC </li>
        <li>layout = the layout template you want to use.  By default you can choose from  “1”, “2”, “3” and “isotope” (1 is a portrait type display with pictures at the top, 2 is a landscape display with picture in a circle, 3 is a landscape display with square picture, isotope is displays pictures only with mouse over text appearing but the order can be sorted by options selected at the top of the page).  Options 2 and 3 also allow you to displat logos in addtion to the speaker’s picture.</li> </ul><br>

        <h3>Changing colours, fonts, etc. in your design template</h3>
        <p>On the ‘Settings’ tab in the left hand menu you can change the appearance of many elements of the speaker profiles.</p>  
        <ul>
        <li>Primary Colour:  Select from pallatte or imput a hex value.</li>
        <li>Square/Rounded Image:  Set a percentage eg 10% </li>
        <li>Image size: Imput pixel size required eg: 200 - note that in some templates the number of columns required may mean this setting is disregarded.</li> 
        <li>Image boder:  You can set the line type, pixel width and colour - eg “Solid 1pt grey” [what are the options?] </li>
        <li>Text options:  Select a colour, Size (eg. “12pt”) and alignment (eg. “left”, “right”, “center”, “none”)</li>
        <li>Show or hide text: toggle between the “show” and “hide” options for each element.</li>
        <li>Slug: speaker</li>
        <li>Link to Detail Page:  Enable links to full page biographical details from some templates </li>
        <li>Custom CSS: Add CSS part with classname you want.</li>
        <li>Save changes:  Don’t forget!</li>
        </ul>
    </div>
    
</div>