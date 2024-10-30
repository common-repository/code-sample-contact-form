<div class="form-contact">
	<?php if (!empty($message)) : ?>
		<div class="message <?php echo !empty($message['mes_sendmail']) ? 'send_success' : ''; ?>">
			<?php foreach ($message as $key => $val) : ?>
				<p><?php echo $val; ?></p>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<form action="#cs_contact" method="post" class="cs-form" id="cs_contact_form" novalidate>
		<?php
		if (!empty($fields)) {
			foreach ($fields as $item) {
				parse_str(str_replace(',', '&', str_replace(':', '=', $item)), $attr);
				load_field_type($attr);
			}
		}
		wp_nonce_field();
		?>
		<?php if (!empty($meta_data['option']['show_captcha'])) : ?>
			<div class="field_captcha cs_field">
				<div class="g-recaptcha" data-sitekey="<?php echo esc_attr($options['setting']['captcha_key']); ?>"></div>
				<span class="error_message"></span>
			</div>
			<script type="text/javascript" src="https://www.google.com/recaptcha/api.js" id="g-recaptcha-js"></script>
		<?php endif; ?>
		<input type="submit" name="submit_form" value="Send" class="btn_submit" />
	</form>
</div>