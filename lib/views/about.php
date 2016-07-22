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


                <?php wp_nonce_field($Speaker->nonceText(), 'agenda_nonce'); ?>

            <!-- Donation Button -->

            <div id="response" class="updated"></div>
        </div>
        <div class="tch-right-pro">
            <div id="pro-feature" class="postbox">
                <div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle ui-sortable-handle"><span>Speaker Pro</span></h3>
                <div class="inside">
                    <p class="heading">Pro Feature</p>
                    <ul class="pro-features">
                        <li>Links to Agenda Pro plugin and gives drop down or Events to show when you can hear this speaker </li>
                        <li>Visual Composer compatibility.</li>
                        <li>Unlimited color.</li>
                        <li>All fields control show/hide.</li>
                        <li>All text size, color and text align control.</li>
                        <li>Square / Rounded Image Style.</li>
                        <li>Grid with Margin or No Margin.</li>
                        <li>Social icon, color size and background color control.</li>
                        <li>Detail page with Popup </li>
                        <li>Can display agenda in columns by stream in pro-version</li>
                    </ul><a href="#" class="button button-primary" target="_blank">Get Pro Version</a>
                </div>
            </div>
        </div>
    </div>
</div>