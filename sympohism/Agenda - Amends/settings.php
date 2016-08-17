<?php
global $Agenda;
$settings = get_option($Agenda->options['settings']);
?>
<div class="wrap">
    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br/></div>
    <h2 class="page-heading"><?php _e('Agenda Settings', AGENDA_SLUG); ?></h2>
    <div class="tlp-content-holder">
        <div class="tch-left">
            <form id="tlp-settings" onsubmit="agendaSettings(this); return false;">

                <h3 class="content-heading"><?php _e('General settings', AGENDA_SLUG); ?></h3>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="primary-color"><?php _e('Leisure Session: Background & Text Colors', AGENDA_SLUG); ?></label>
                        </th>
                        <td class="">
                            <input name="primary_color" id="primary_color" type="text"
                                   value="<?php echo(isset($settings['primary_color']) ? ($settings['primary_color'] ? $settings['primary_color'] : '#4b4b4b') : '#4b4b4b'); ?>"
                                   class="tlp-color">

                            <input name="ltext_color" id="ltext_color" type="text"
                                   value="<?php echo(isset($settings['ltext_color']) ? ($settings['ltext_color'] ? $settings['ltext_color'] : '#fff') : '#fff'); ?>"
                                   class="tlp-color">

                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="table-color"><?php _e('Table Base Color', AGENDA_SLUG); ?></label>
                        </th>
                        <td class="">
                            <input name="table_color" id="table_color" type="text"
                                   value="<?php echo(isset($settings['table_color']) ? ($settings['table_color'] ? $settings['table_color'] : '') : ''); ?>"
                                   class="tlp-color">

                        </td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="slug"><?php _e('Slug', AGENDA_SLUG); ?></label></th>
                        <td class="">
                            <input name="slug" id="slug" type="text"
                                   value="<?php echo(isset($settings['slug']) ? ($settings['slug'] ? sanitize_title_with_dashes($settings['slug']) : 'agenda') : 'agenda'); ?>"
                                   size="15" class="">
                            <p class="description"><?php _e('Slug configuration', AGENDA_SLUG); ?></p>
                        </td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="text-color"><?php _e('Session Title: Color, Text Size & Margin',SPEAKER_SLUG);?></label></th>
                        <td class="">
                            <span style="display:block;"><input name="text_color" id="text_color" type="text" value="<?php echo (isset($settings['text_color']) ? ($settings['text_color'] ? $settings['text_color'] : '#4a4a4a') : '#4a4a4a'); ?>" class="tlp-color"></span>
                            <span style="display:block;margin-bottom:5px;"><input name="text_size" id="text_size" type="text" value="<?php echo (isset($settings['text_size']) ? ($settings['text_size'] ? $settings['text_size'] : '15px') : '15px'); ?>"></span>
                            <span style="display:block;"><input name="text_align" id="text_align" type="text" value="<?php echo (isset($settings['text_align']) ? ($settings['text_align'] ? $settings['text_align'] : 'none') : 'none'); ?>"></span>
                            
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label
                                for="bullet_point"><?php _e('Styling Bullet Points', AGENDA_SLUG); ?></label></th>
                        <td class="">
                            <select name="bullet_point" id="bullet_point" type="text"
                                    value="<?php echo(isset($settings['bullet_point']) ? ($settings['bullet_point'] ? $settings['bullet_point'] : 'circle') : 'circle'); ?>">
                                <option value="none">none</option>
                                <option value="circle">circle</option>
                                <option value="square">square</option>
                                <option value="disc">disc</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="css"><?php _e('Custom Css ', AGENDA_SLUG); ?></label></th>
                        <td>
                            <textarea name="custom_css" cols="40"
                                      rows="6"><?php echo(isset($settings['custom_css']) ? ($settings['custom_css'] ? $settings['custom_css'] : null) : null); ?></textarea>
                        </td>
                    </tr>


                </table>
                <p class="submit"><input type="submit" name="submit" id="SaveButton" class="button button-primary"
                                         value="<?php _e('Save Changes', AGENDA_SLUG); ?>"></p>

                <?php wp_nonce_field($Agenda->nonceText(), 'agenda_nonce'); ?>
            </form>

            <div id="response" class="updated"></div>
        </div>
    </div>
    <!-- <div class="tlp-help">
        <p style="font-weight: bold"><?php _e('Short Code', AGENDA_SLUG); ?> :</p>
        <code>[agenda orderby="title" layout="1"]</code><br>
        <p><?php _e('orderby = time|speaker', AGENDA_SLUG); ?></p>
        <p><?php _e('layout = 1,isotope', AGENDA_SLUG); ?></p></br>
        <p class="tlp-help-link"><a class="button-primary" href="http://http://www.blackandwhitedigital.eu/symposium-meeting-agenda-plugin/" target="_blank"><?php _e('Demo', AGENDA_SLUG );?></a></p>
    </div> -->

</div>
