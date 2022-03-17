<?php

/**
 * Configuration form.
 *
 * @link	https://www.kwanko.com
 * @since	1.0.0
 *
 * @package		Kwanko_Adv
 * @subpackage	Kwanko_Adv/admin/partials
 */

// check user capabilities
if ( ! current_user_can('manage_options') ) {
	return;
}

// show error/update messages
settings_errors('kwanko-adv-messages');
?>

<style>
	table.form-table {
		margin-top: 30px;
		margin-bottom: 30px;
	}
	.kwanko-hidden-field {
		display: none;
	}
</style>

<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<form method="post" enctype="multipart/form-data">
		<?php
		settings_fields('kwanko-adv');
		do_settings_sections('kwanko-adv');
		submit_button(__('Save Settings', 'kwanko-adv'));
		?>
	</form>
</div>

<script>
	(function() {
		var uniJsRow = document.querySelector('.unijs-tracking-field');
		var uniJsInput = document.getElementById('uniJsTracking');

		if (!uniJsRow
			&& uniJsInput
			&& uniJsInput.parentNode
			&& uniJsInput.parentNode.tagName === 'TD'
			&& uniJsInput.parentNode.parentNode
			&& uniJsInput.parentNode.parentNode.tagName === 'TR'
		) {
			// for old versions of wordpress
			uniJsRow = uniJsInput.parentNode.parentNode;
			uniJsRow.classList.add('kwanko-hidden-field');
		}

		window.kwanko_show_hidden_inputs = function() {
			if (uniJsRow) {
				uniJsRow.classList.remove('kwanko-hidden-field');
			}
		};

		<?php
		if ( isset($show_hidden_inputs) && $show_hidden_inputs ) {
			echo 'window.kwanko_show_hidden_inputs();';
		}
		?>
	})();
</script>