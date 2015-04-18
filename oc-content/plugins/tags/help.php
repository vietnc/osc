<?php

/*

 *      OSCLass – software for creating and publishing online classified

 *                           advertising platforms

 *

 *                        Copyright (C) 2010 OSCLASS

 *

 *       This program is free software: you can redistribute it and/or

 *     modify it under the terms of the GNU Affero General Public License

 *     as published by the Free Software Foundation, either version 3 of

 *            the License, or (at your option) any later version.

 *

 *     This program is distributed in the hope that it will be useful, but

 *         WITHOUT ANY WARRANTY; without even the implied warranty of

 *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

 *             GNU Affero General Public License for more details.

 *

 *      You should have received a copy of the GNU Affero General Public

 * License along with this program.  If not, see <http://www.gnu.org/licenses/>.

 */

?>



<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">

    <div style="padding: 0 20px 20px;">

        <div>

           <fieldset>

                <legend>

                    <h1><?php _e('Tags Plugin Help', 'tags'); ?></h1>

                </legend>

                <h2>

                    <?php _e('What is Tags Plugin?', 'tags'); ?>

                </h2>

                <p>

                    <?php _e('Tags Plugin enables you to show tags in item page either filled by users or selected from admin tags list.', 'tags'); ?>

                </p>
                
                <h2>

                    <?php _e('How Tags Plugin Work?', 'tags'); ?>

                </h2>

                <p>

                    <?php _e('When installed, tags plugin, will add a form in item post/edit asking users to add tags to their ad.<br/>
					The tags will show on item page and, when clicked, will open the search page showing all ads with that tag.<br/>
					If users don\'t add any tag, the plugin will automatically add tags based on item description and tags set by admin.', 'tags'); ?>

                </p>
                
                <h2>

                    <?php _e('Limiting number of tags that user can post.', 'tags'); ?>

                </h2>

                <p>

                    <?php _e('In plugin admin you can set the number of tags.', 'tags'); ?>

                </p>
                
                <h2>

                    <?php _e('How auto admin tags work?', 'tags'); ?>

                </h2>

                <p>

                    <?php _e('First you need to insert in the text area the most common words used in item description on your site.<br/>
					(word by word, separated by commas, without spaces. Last word without comma. For instance: house,car,shoes,bike,sale,rent)<br/>
					<span style="font-weight:bold; color:#FF0000;">Important!</span> Auto tag does not recognize double words tags, only single word. Instead, the users, can post multi word tags.<br/>
					If user don\'t add any tag when he post a new ad, as soon the ad page is open, the tags are created by the plugin based on the list you provided and stored in DB.<br/><span style="font-weight:bold; color:#FF0000;">YOU NEED TO RELOAD THE ITEM PAGE TO SEE THE TAGS</span>.', 'tags'); ?>

                </p>

                
                <h2><?php _e('Changing between CSS styled tags or Text tags', 'tags'); ?>

                </h2>

                <p>

                <?php _e('In plugin admin page you can change between the two options', 'tags'); ?>

                </p>
                
                <h2><?php _e('If you feel generous, you can donate to osclass team for their excellent work.', 'tags'); ?>

                </h2>

                <p>

                <?php _e('If you feel VERY generous and If you find this plugin useful , you can donate to me using paypal to this email: wallet@swappingol.com', 'tags'); ?>

                </p>                

            </fieldset>

        </div>

    </div>

</div>

