<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://codesamples.info
 * @since      1.0.0
 *
 * @package    Wp_codesample_contact
 * @subpackage Wp_codesample_contact/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="wpbody" role="main">
	<div id="wpbody-content">
		<div class="wrap" id="wpcf7-contact-form-list-table">
			<h1 class="wp-heading-inline">CS Contact Form</h1>
			<a href="<?php echo esc_html(admin_url('admin.php?page=add_cs_contact', 'administrator')); ?>" class="page-title-action">Add New</a>
			<hr class="wp-header-end">

			<form method="get" action="">
				<input type="hidden" name="page" value="cs_contact">

				<?php //wp_nonce_field();?>
				<div class="tablenav top">
					<div class="alignleft actions bulkactions">
						<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
						<select name="action" id="bulk-action-selector-top">
							<option value="-1">Bulk actions</option>
							<option value="delete">Delete</option>
						</select>
						<input type="submit" id="doaction" class="button action" value="Apply">
						<a target="_blank" class="btn_upgrade" href="http://codesamples.info/contact-form-plugin/">Upgrade To Premium</a>
					</div>
					<br class="clear">
				</div>
				<table class="wp-list-table widefat fixed striped table-view-list posts">
					<thead>
						<tr>
							<td id="cb" class="manage-column column-cb check-column">
								<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
								<input id="cb-select-all-1" type="checkbox">
							</td>
							<th scope="col" id="title" class="manage-column column-title column-primary sortable asc"><a href="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>&amp;orderby=title&amp;order=desc"><span>Title</span><span class="sorting-indicator"></span></a></th>
							<th scope="col" id="shortcode" class="manage-column column-shortcode">Shortcode</th>
							<th scope="col" id="author" class="manage-column column-author sortable desc"><a href="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>&amp;orderby=author&amp;order=asc"><span>Author</span><span class="sorting-indicator"></span></a></th>
							<th scope="col" id="date" class="manage-column column-date sortable desc"><a href="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>&amp;orderby=date&amp;order=asc"><span>Date</span><span class="sorting-indicator"></span></a></th>
						</tr>
					</thead>

					<tbody id="the-list" data-wp-lists="list:post">
						<?php $message = end(array_keys($_GET)); ?>
						<?php if ($message == 'success') : ?>
							<div class="updated">
								<p><?php echo str_replace('-', ' ', sanitize_text_field($_GET[$message])); ?></p>
							</div>
						<?php endif; ?>
						<?php if ($message == 'error') : ?>
							<div class="error">
								<p><?php echo str_replace('-', ' ', sanitize_text_field($_GET[$message])); ?></p>
							</div>
						<?php endif; ?>

						<?php if (!empty($list_post)) : ?>
							<?php
							while ($list_post->have_posts()) :
								$list_post->the_post(); ?>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="post[]" value="<?php the_ID();?>"></th>
									<td class="title column-title has-row-actions column-primary" data-colname="Title">
										<strong>
											<a class="row-title" href="<?php echo esc_html(admin_url('admin.php?page=cs_contact&post=' . get_the_ID() . '&action=edit', 'administrator')); ?>"><?php the_title(); ?></a></strong>
										<div class="row-actions">
											<span class="edit">
												<a href="<?php echo esc_html(admin_url('admin.php?page=cs_contact&post=' . get_the_ID() . '&action=edit', 'administrator')); ?>">Edit</a> |
											</span>
											<span class="delete">
												<a class="delete" href="<?php echo esc_html(wp_nonce_url(admin_url('admin.php?page=cs_contact&post=' . get_the_ID() . '&action=delete', 'administrator')), get_the_ID()); ?>">Delete</a>
											</span>
										</div>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="shortcode column-shortcode" data-colname="Shortcode">
										<span class="shortcode">
											<input type="text" onfocus="this.select();" readonly="readonly" value="[cs-contact id=<?php the_ID() ?>]" class="large-text code">
										</span>
									</td>
									<td class="author column-author" data-colname="Author"><?php the_author(); ?></td>
									<td class="date column-date" data-colname="Date"><?php echo get_the_date('d-m-Y H:s:i'); ?></td>
								</tr>
							<?php endwhile;
							wp_reset_postdata(); ?>
						<?php endif; ?>
					</tbody>

					<tfoot>
						<tr>
							<td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox"></td>
							<th scope="col" class="manage-column column-title column-primary sortable asc"><a href="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>&amp;orderby=title&amp;order=desc"><span>Title</span><span class="sorting-indicator"></span></a></th>
							<th scope="col" class="manage-column column-shortcode">Shortcode</th>
							<th scope="col" class="manage-column column-author sortable desc"><a href="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>&amp;orderby=author&amp;order=asc"><span>Author</span><span class="sorting-indicator"></span></a></th>
							<th scope="col" class="manage-column column-date sortable desc"><a href="<?php echo esc_html(admin_url('admin.php?page=cs_contact', 'administrator')); ?>&amp;orderby=date&amp;order=asc"><span>Date</span><span class="sorting-indicator"></span></a></th>
						</tr>
					</tfoot>

				</table>
			</form>

		</div>

		<div class="clear"></div>
	</div><!-- wpbody-content -->
	<div class="clear"></div>
</div>