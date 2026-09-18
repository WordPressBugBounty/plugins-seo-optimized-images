<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$default_options_data = array (
	'soi_alt_value' => '%name %title',
	'soi_title_value' => '',
	'soi_override_alt_value' => '1',
	'soi_override_title_value' => '1',
);      
// If there is no option setting in DB then assign default data to soi option array..      
$soi_options_array = wp_parse_args(get_option('soi_options_values'), $default_options_data); 
if (isset($_POST['submit_general_settings_tab'])) {
    if (!isset($_POST['general_settings_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['general_settings_nonce'])), 'general_settings_action')) {
        wp_die(esc_html__('Nonce verification failed', 'seo-optimized-images'));
    }

    if (isset($_POST['soi_alt_value'])) {
        $soi_options_array['soi_alt_value'] = wp_kses_post(wp_unslash($_POST['soi_alt_value']));
    }

    if (isset($_POST['soi_title_value'])) {
        $soi_options_array['soi_title_value'] = wp_kses_post(wp_unslash($_POST['soi_title_value']));
    }

    if (isset($_POST['soi_override_alt_value'])) {
        $soi_options_array['soi_override_alt_value'] = wp_kses_post(wp_unslash($_POST['soi_override_alt_value']));
    }

    if (isset($_POST['soi_override_title_value'])) {
        $soi_options_array['soi_override_title_value'] = wp_kses_post(wp_unslash($_POST['soi_override_title_value']));
    }
    update_option('soi_options_values', $soi_options_array);
}
?>
<div class="wrap settings-wrap" id="page-settings">
    <h2><?php esc_html_e('Settings','seo-optimized-images');?></h2>
    <div id="option-tree-header-wrap">
        <ul id="option-tree-header">
            <li id="option-tree-version"><span><?php esc_html_e('SEO Optimized Images','seo-optimized-images'); ?></span>
            </li>
        </ul>
    </div>
    <div id="option-tree-settings-api">
    	<div id="option-tree-sub-header"></div>
	        <div class = "ui-tabs ui-widget ui-widget-content ui-corner-all"> 
				<!-- Tabs Begin-->
	            <ul >
	                <li id="tab_create_setting"><a href="#section_general"><?php esc_html_e('General Settings','seo-optimized-images');?></a>
	                </li>
	                <li id="tab_faq" ><a href="#section_faq"><?php esc_html_e('FAQ','seo-optimized-images');?></a>
	                </li>
	                <li id="tab_support" ><a href="#section_support"><?php esc_html_e('Support','seo-optimized-images');?></a>
	                </li>
					<li id="tab_other" ><a href="#section_other"><?php esc_html_e('Upgrade to PRO','seo-optimized-images');?></a>
	                </li>
	            </ul>
	            <!-- Tabs End-->
	    		<div id="poststuff" class="metabox-holder">
	        		<div id="post-body">
						<div id="post-body-content">
	                		<div id="section_general" class = "postbox">
	                    		<div class="inside">
	                				<div id="setting_theme_options_ui_text" class="format-settings">
	                            		<div class="format-setting-wrap">
	    									<div class = "format-setting type-textarea has-desc">
	        									<div class = "format-setting-inner">            
	    											<form method="post" action="#section_general">
													 	<?php wp_nonce_field('general_settings_action','general_settings_nonce');?>
														<div class="format-setting-label">
															<h3 class="label"><?php esc_html_e('General Settings','seo-optimized-images');?></h3>
														</div>						
	    												<table class="form-table table_custom">    
													        <tr valign="top">
													        	<th scope="row"><?php esc_html_e('Alt attribute value','seo-optimized-images');?></th>
												        		<td><input type="text" name="soi_alt_value" value="<?php echo esc_attr( $soi_options_array['soi_alt_value'] ); ?>" />
												        			<p><?php esc_html_e('The Alt attributes will be dynamically replaced by the above value.', 'seo-optimized-images');?></p>
												     				<p> 
												     					%name - <?php esc_html_e('Will insert image name.','seo-optimized-images');?><br> 
												     					%title- <?php esc_html_e('Will insert post title.','seo-optimized-images');?><br>
												             			%category - <?php esc_html_e('Will insert post categories.','seo-optimized-images');?>
											         				</p>
												        		</td>
													        </tr>
	        
															<tr valign="top">
																<th scope="row"><?php esc_html_e('Override existing alt tag','seo-optimized-images');?></th>
																<td>
																	<select id="soi_override_alt_value" name="soi_override_alt_value">
																		<?php $override_setting = array('1'=> __('YES','seo-optimized-images'), '0'=> __('NO','seo-optimized-images')); ?>
																		<?php foreach($override_setting as $key => $value) { ?>
																			<option value="<?php echo esc_attr($key); ?>" <?php if ($soi_options_array['soi_override_alt_value']==$key) { echo 'selected="selected"'; } ?>  >
																			<?php echo esc_html($value); ?> </option>
																		<?php } ?>
																	</select>
																	<p><?php esc_html_e('Do you want to override existing alt tags?','seo-optimized-images');?></p>
																</td>
															</tr>
	    
															<tr valign="top">
																<th scope="row"><?php esc_html_e('Title attribute value','seo-optimized-images');?></th>
																<td><input type="text" name="soi_title_value" value="<?php echo esc_attr( $soi_options_array['soi_title_value'] ); ?>" />
																	<p><?php esc_html_e('The Title attribute will be dynamically replaced by the above value.', 'seo-optimized-images');?></p>
																</td>
															</tr> 
	    
															<tr valign="top">
																<th scope="row"><?php esc_html_e('Override existing title tag','seo-optimized-images');?></th>
																<td>
																	<select id="soi_override_title_value" name="soi_override_title_value">
																		<?php $override_setting = array('1'=> __('YES','seo-optimized-images'), '0'=> __('NO','seo-optimized-images')); ?>
																		<?php foreach($override_setting as $key => $value) { ?>
																			<option value="<?php echo esc_attr($key); ?>" <?php if ($soi_options_array['soi_override_title_value']==$key) { echo 'selected="selected"'; } ?>  >
																			<?php echo esc_html($value); ?> </option>
																		<?php } ?>
																	</select>
																	<p><?php esc_html_e('Do you want to override existing title tags?','seo-optimized-images'); ?></p>
																</td>
															</tr>
			
															<tr valign="top">
																<th scope="row"><?php esc_html_e('Override alt and title attributes of feature/thumbnail images.','seo-optimized-images');?></th>
																<td>
																	<select disabled>
																		<?php $override_setting = array('1'=> __('YES','seo-optimized-images'), '0'=> __('NO','seo-optimized-images')); ?>
																		<?php foreach($override_setting as $key => $value) { ?>
																			<option value="<?php echo esc_attr($key); ?>" <?php if (isset($soi_options_array['soi_override_thumbnail_images'])==$key) { echo 'selected="selected"'; } ?>  >
																			<?php echo esc_html($value); ?> </option>
																		<?php } ?>
																	</select>
																	<p><?php esc_html_e('Do you want to optimize post/page thumbnail images or to make images SEO friendly?','seo-optimized-images');?><a class="prolinkbtn"><?php esc_html_e('Available In PRO','seo-optimized-images'); ?></a></p>
																</td>
															</tr>
	        
															<tr valign="top">
																<th scope="row"><?php esc_html_e('Override alt and title tags of WooCommerce products images.','seo-optimized-images');?></th>
																<td>
																	<select disabled>
																		<?php $override_setting = array('1'=> __('YES','seo-optimized-images'), '0'=> __('NO','seo-optimized-images')); ?>
																		<?php foreach($override_setting as $key => $value) { ?>
																			<option value="<?php echo esc_attr($key); ?>" <?php if (isset($soi_options_array['soi_override_woo_thumbnail_images'])==$key) { echo 'selected="selected"'; } ?>  >
																			<?php echo esc_html($value); ?> </option>
																		<?php } ?>
																	</select>
																	<p><?php esc_html_e('Do you want to optimize WooCommerce images or make them search engine friendly?','seo-optimized-images');?><a class="prolinkbtn" ><?php esc_html_e('Available In PRO','seo-optimized-images'); ?></a></p>
																</td>
															</tr>
			
															<tr valign="top">
																<th scope="row"><?php esc_html_e('Enable Yoast primary category','seo-optimized-images');?></th>
																<td>
																	<input type="checkbox" id="soi_override_yost_primary_cat" name="soi_override_yost_primary_cat" value="1" <?php if( isset($soi_options_array['soi_override_yost_primary_cat']) == true ) echo "checked"; ?> disabled>
																	<p><?php esc_html_e('Show only primary category created by Yoast SEO Plugin.', 'seo-optimized-images');?><a class="prolinkbtn" ><?php esc_html_e('Available In PRO','seo-optimized-images');?></a></p>
																</td>
															</tr>
														</table>
			
														<table class="form-table ">  
															<tr valign="top">
												        		<td><input type="submit" name="submit_general_settings_tab" value="<?php esc_attr_e('Save Changes','seo-optimized-images'); ?>" class="button button-primary"></td>
												        	</tr>
														</table>
													</form>
												</div>
											</div>
										</div>
	         						</div>
	        					</div>
	    					</div>
							<div id="section_faq" class="postbox">
								<div class="inside seo-optimized-images-faq">

									<div class="faq-item">
										<h3 class="faq-question">
											<?php esc_html_e( 'Does this change my database?', 'seo-optimized-images' ); ?>
										</h3>

										<p>
											<?php esc_html_e( 'No. Nothing is written to your database. The plugin fills in the alt and title attributes when the page loads, so your original data is never touched and you can reverse everything at any time.', 'seo-optimized-images' ); ?>
										</p>
									</div>

									<div class="faq-item">
										<h3 class="faq-question">
											<?php esc_html_e( 'What happens if I deactivate the plugin?', 'seo-optimized-images' ); ?>
										</h3>

										<p>
											<?php esc_html_e( 'Your site reverts to exactly how it was. There is no cleanup to do and no leftover data to remove, because nothing was ever saved.', 'seo-optimized-images' ); ?>
										</p>
									</div>

									<div class="faq-item">
										<h3 class="faq-question">
											<?php esc_html_e( 'How does it work?', 'seo-optimized-images' ); ?>
										</h3>

										<p>
											<?php esc_html_e('You set a pattern once in General Settings. The plugin applies it to the alt and title attributes of every image across your site. Because nothing is stored, the same image can carry different alt and title text on different pages — which no plugin that writes to the database can do.', 'seo-optimized-images' ); ?>
										</p>

										<div class="faq-placeholders">
											<div class="faq-placeholder-title">
												<?php esc_html_e( 'Available placeholders', 'seo-optimized-images' ); ?>
											</div>

											<div class="faq-placeholder">
												<code>%name</code>
												<span><?php esc_html_e( 'image name', 'seo-optimized-images' ); ?></span>
											</div>

											<div class="faq-placeholder">
												<code>%title</code>
												<span><?php esc_html_e( 'post title', 'seo-optimized-images' ); ?></span>
											</div>

											<div class="faq-placeholder">
												<code>%category</code>
												<span><?php esc_html_e( 'post categories', 'seo-optimized-images' ); ?></span>
											</div>
										</div>
									</div>

									<div class="faq-item">
										<h3 class="faq-question">
											<?php esc_html_e( 'Why do alt and title attributes matter?', 'seo-optimized-images' ); ?>
										</h3>

										<p>
											<?php esc_html_e( 'Alt text is what screen readers read out to people who cannot see an image, and what search engines use to understand what the image shows. The WebAIM Million 2026 report found that 53.1% of websites have at least one image with no alt text, making it one of the most common accessibility failures on the web.', 'seo-optimized-images' ); ?>
										</p>

										<p>
											<?php esc_html_e( 'Title attributes show as a tooltip when someone hovers over an image, and give you a second place to describe it. This plugin sets both, so you do not have to handle them separately.', 'seo-optimized-images' ); ?>
										</p>
									</div>

									<div class="faq-item">
										<h3 class="faq-question">
											<?php esc_html_e( 'Will it slow down my site?', 'seo-optimized-images' ); ?>
										</h3>

										<p>
											<?php esc_html_e( 'No. The attributes are filled in as the page renders, with no extra database queries.', 'seo-optimized-images' ); ?>
										</p>
									</div>

								</div>
							</div>
							<div id="section_support" class = "postbox">
							    <div class="inside">
							        <div class="format-settings">
							            <div class="format-setting-wrap">
							                <div class="format-setting-label">
							                	<h3 class="label"><?php esc_html_e('Support','seo-optimized-images'); ?> </h3>
							                </div>
							            </div>
							        </div>                  
									<p><span class="description">
									<?php 
									echo wp_kses(sprintf(
										// Translators: %s is the URL to get support for the plugin.
											__("1. For any queries contact us via the <a href='%s' target='_blank'>support forums</a>.", "seo-optimized-images"),
											esc_url('https://wordpress.org/support/plugin/seo-optimized-images')
										),
										array(
											'a' => array(
												'href' => array(),
												'target' => array(),
											)
										)
									);
									?>
									</span></p>
							    	<p><span class="description">
									<?php 
									echo wp_kses(sprintf(
											// Translators: %s is the URL to give review for the plugin.
											__('2. If you like our plugin and support, then kindly share your <a href="%s" target="_blank">feedback</a>. Your feedback is valuable.', 'seo-optimized-images'),
											esc_url('https://wordpress.org/support/view/plugin-reviews/seo-optimized-images')
										),
										array(
											'a' => array(
												'href' => array(),
												'target' => array(),
											)
										)
									);
									?>
									</span></p>               
								</div>
							</div>
							<div id="section_other" class="postbox">
								<div class="inside seo-optimized-images-upgrade">

									<div class="upgrade-intro">
										<h3>
											<?php esc_html_e( 'Set your alt and title tags once. Applied across your whole site.', 'seo-optimized-images' ); ?>
										</h3>

										<p>
											<?php esc_html_e( 'Without writing anything to your database. Reversible any time.', 'seo-optimized-images' ); ?>
										</p>
									</div>

									<div class="upgrade-comparison">
										<table class="upgrade-table">
											<thead>
												<tr>
													<th scope="col"></th>
													<th scope="col">
														<?php esc_html_e( 'Free', 'seo-optimized-images' ); ?>
													</th>
													<th scope="col">
														<?php esc_html_e( 'Business', 'seo-optimized-images' ); ?>
													</th>
													<th scope="col">
														<?php esc_html_e( '+ WooCommerce', 'seo-optimized-images' ); ?>
													</th>
												</tr>
											</thead>

											<tbody>

												<tr>
													<th scope="row">
														<?php esc_html_e( 'Post and page images', 'seo-optimized-images' ); ?>
													</th>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
												</tr>

												<tr>
													<th scope="row">
														<?php esc_html_e( 'Featured images', 'seo-optimized-images' ); ?>
													</th>
													<td>
														<span class="upgrade-cross" aria-label="<?php esc_attr_e( 'Not available', 'seo-optimized-images' ); ?>">×</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
												</tr>

												<tr>
													<th scope="row">
														<?php esc_html_e( 'Custom post types', 'seo-optimized-images' ); ?>
													</th>
													<td>
														<span class="upgrade-cross" aria-label="<?php esc_attr_e( 'Not available', 'seo-optimized-images' ); ?>">×</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
												</tr>

												<tr>
													<th scope="row">
														<?php esc_html_e( 'Custom rules', 'seo-optimized-images' ); ?>
													</th>
													<td>
														<span class="upgrade-cross" aria-label="<?php esc_attr_e( 'Not available', 'seo-optimized-images' ); ?>">×</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
												</tr>

												<tr>
													<th scope="row">
														<?php esc_html_e( 'WooCommerce product images', 'seo-optimized-images' ); ?>
													</th>
													<td>
														<span class="upgrade-cross" aria-label="<?php esc_attr_e( 'Not available', 'seo-optimized-images' ); ?>">×</span>
													</td>
													<td>
														<span class="upgrade-cross" aria-label="<?php esc_attr_e( 'Not available', 'seo-optimized-images' ); ?>">×</span>
													</td>
													<td>
														<span class="upgrade-check" aria-label="<?php esc_attr_e( 'Available', 'seo-optimized-images' ); ?>">✓</span>
													</td>
												</tr>

											</tbody>
										</table>
									</div>

									<div class="upgrade-buttons">

										<a class="upgrade-button" href="<?php echo esc_url( 'https://checkout.freemius.com/plugin/11446/plan/19501/?source=plugin_dashboard' ); ?>" target="_blank" rel="noopener noreferrer">
											<?php esc_html_e( 'Business — $69 / year', 'seo-optimized-images' ); ?>
										</a>

										<a class="upgrade-button" href="<?php echo esc_url( 'https://checkout.freemius.com/plugin/11446/plan/19458/?source=plugin_dashboard' ); ?>" target="_blank" rel="noopener noreferrer">
											<?php esc_html_e( '+ WooCommerce — $89 / year', 'seo-optimized-images' ); ?>
										</a>

									</div>

									<div class="upgrade-guarantee">
										<span class="upgrade-guarantee-icon" aria-hidden="true">✓</span>
										<span><?php esc_html_e( '15-day money-back guarantee — not satisfied? Email us and we refund right away.', 'seo-optimized-images' ); ?></span>
									</div>

									<p class="upgrade-note">
										<?php esc_html_e( 'Includes 1 year of updates and support. Keep using the plugin after that, or renew to continue receiving both.', 'seo-optimized-images'); ?>
									</p>

								</div>
							</div>
	        			</div>
	    			</div>
	    		</div>
	        <div class="clear"></div>
        </div>
    </div>
</div>