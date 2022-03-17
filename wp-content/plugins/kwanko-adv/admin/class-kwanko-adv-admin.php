<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link	https://www.kwanko.com
 * @since	1.0.0
 *
 * @package		Kwanko_Adv
 * @subpackage	Kwanko_Adv/admin
 */

/**
 * Configuration page.
 *
 * @package		Kwanko_Adv
 * @subpackage	Kwanko_Adv/admin
 * @author		Kwanko <support@kwanko.com>
 */
class Kwanko_Adv_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string	$plugin_name	The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string	$version	The current version of this plugin.
	 */
	private $version;

	/**
	 * @var Kwanko_Adv_Settings
	 */
	protected $settings;

	/**
	 * @var Kwanko_Adv_Tags
	 */
	protected $tags;

	/**
	 * @var string
	 */
	protected $unijs_file_path;

	/**
	 * @var array
	 */
	protected $form_values;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 *
	 * @param	string	$plugin_name	The name of this plugin.
	 * @param	string	$version		The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		try {
			// set dependencies
			$this->settings = new Kwanko_Adv_Settings();
			$this->settings->load();

			$this->tags = new Kwanko_Adv_Tags($this->settings);

			$this->unijs_file_path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'uni.js';

			// sync the uniJsFileLastUpload setting if the uniJs file does not exist
			if ( ! file_exists($this->unijs_file_path) && $this->settings->get('uniJsFileLastUpload') !== null) {
				$this->settings->set('uniJsFileLastUpload', null);
				$this->settings->save();
				$this->settings->load();
			}

		} catch (\Exception $e) {}

	}

	/**
	 * Add settings link in the plugin page.
	 *
	 * @since	1.0.0
	 */
	public function add_action_links($links) {

		$link = '<a href="'. admin_url('options-general.php?page=kwanko-adv') .'">'.__('Settings', 'kwanko-adv').'</a>';

		array_unshift($links, $link);

		return $links;

	}

	/**
	 * Register the settings page.
	 *
	 * @since	1.0.0
	 */
	public function add_option_page() {

		add_options_page(
			__('Kwanko - Tracking Tags for Advertisers', 'kwanko-adv'),
			__('Kwanko - Tracking Tags for Advertisers', 'kwanko-adv'),
			'manage_options',
			'kwanko-adv',
   			array($this, 'settings_page')
		);

	}

	/**
	 * Show the settings page.
	 *
	 * @since	1.0.0
	 */
	public function settings_page() {

		$this->register_settings();

		if ( strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' ) {
			$this->form_values = array(
				'uniJsFile' => isset($_FILES['uniJsFile']['name']) ? (string) $_FILES['uniJsFile']['name'] : '',
				'uniJsFileUrl' => isset($_POST['uniJsFileUrl']) ? (string) $_POST['uniJsFileUrl'] : '',
				'mclic' => isset($_POST['mclic']) ? (string) $_POST['mclic'] : '',
				'newCustomerMclic' => isset($_POST['newCustomerMclic']) ? (string) $_POST['newCustomerMclic'] : '',
				'cpaRetargeting' => isset($_POST['cpaRetargeting']) ? (bool) $_POST['cpaRetargeting'] : false,
				'emailRetargeting' => isset($_POST['emailRetargeting']) ? (bool) $_POST['emailRetargeting'] : false,
				'uniJsTracking' => isset($_POST['uniJsTracking']) ? (bool) $_POST['uniJsTracking'] : true,
				'productIdType' => isset($_POST['productIdType']) ? (string) $_POST['productIdType'] : 'id',
			);

			if ( $this->validate_form() ) {
				$this->save_form_values();
			}
		} else {
			$this->form_values = array(
				'uniJsFileUrl' => $this->settings->get('uniJsFileUrl'),
				'mclic' => $this->settings->get('mclic'),
				'newCustomerMclic' => $this->settings->get('newCustomerMclic'),
				'cpaRetargeting' => $this->settings->get('cpaRetargeting'),
				'emailRetargeting' => $this->settings->get('emailRetargeting'),
				'uniJsTracking' => $this->settings->get('uniJsTracking'),
				'productIdType' => $this->settings->get('productIdType'),
			);
		}

		$show_hidden_inputs = isset($this->form_values['uniJsTracking']) && !$this->form_values['uniJsTracking'];

		// check if woocommerce is activated
		if ( ! class_exists('woocommerce') ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-wc', __('This plugin can not work without WooCommerce and WooCommerce is not activated !', 'kwanko-adv'), 'error');
		}

		require dirname(__FILE__).'/partials/kwanko-adv-admin-display.php';

	}

	/**
	 * Format and validate the form values.
	 * Add error messages with add_settings_error.
	 *
	 * @since	1.0.0
	 *
	 * @return  bool	true if the form values are valid
	 */
	protected function validate_form() {

		// ensure that the UniJS file is uploaded if it has not been uploaded before
		$this->form_values['uniJsFileUrl'] = trim($this->form_values['uniJsFileUrl']);

		if ( $this->settings->get('uniJsFileLastUpload') === null && $this->form_values['uniJsFile'] === '' && $this->form_values['uniJsFileUrl'] === '' ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-unijs', __('You need to upload the UniJS file.', 'kwanko-adv'), 'error');
			return false;
		}

		// format and validate mclic
		$this->form_values['mclic'] = trim($this->form_values['mclic']);
		$this->form_values['newCustomerMclic'] = trim($this->form_values['newCustomerMclic']);

		if ( $this->form_values['mclic'] === '' ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-mclic-empty', __('The MCLIC can not be empty.', 'kwanko-adv'), 'error');
			return false;
		}

		if ( Kwanko_Adv_Mclic_Decoder::decode($this->form_values['mclic']) === false ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-mclic', __('The MCLIC is not valid.', 'kwanko-adv'), 'error');
			return false;
		}

		if ( $this->form_values['newCustomerMclic'] !== '' && Kwanko_Adv_Mclic_Decoder::decode($this->form_values['newCustomerMclic']) === false ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-mclic-new', __('The MCLIC for the new customers is not valid.', 'kwanko-adv'), 'error');
			return false;
		}

		if ( !in_array($this->form_values['productIdType'], ['id', 'sku']) ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-product-id-type', __('The type of product ID is not valid.', 'kwanko-adv'), 'error');
			return false;
		}

		return true;

	}

	/**
	 * Save the form values in the database.
	 * Add success or error messages with add_settings_error.
	 *
	 * @since	1.0.0
	 */
	protected function save_form_values() {

		if ( $this->form_values['uniJsFile'] ) {
			if ( ! isset($_FILES['uniJsFile']['tmp_name']) || empty($_FILES['uniJsFile']['tmp_name']) ) {
				add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-unijs-up', __('Could not upload the UniJS file.', 'kwanko-adv'), 'error');
				return;
			}

			if ( ! move_uploaded_file($_FILES['uniJsFile']['tmp_name'], $this->unijs_file_path) ) {
				add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-unijs-up', __('Could not upload the UniJS file.', 'kwanko-adv'), 'error');
				return;
			}

			$this->settings->set('uniJsFileLastUpload', time());
		}

		$this->settings->set('uniJsFileUrl', $this->form_values['uniJsFileUrl']);
		$this->settings->set('mclic', $this->form_values['mclic']);
		$this->settings->set('newCustomerMclic', $this->form_values['newCustomerMclic']);
		$this->settings->set('cpaRetargeting', $this->form_values['cpaRetargeting']);
		$this->settings->set('emailRetargeting', $this->form_values['emailRetargeting']);
		$this->settings->set('uniJsTracking', $this->form_values['uniJsTracking']);
		$this->settings->set('productIdType', $this->form_values['productIdType']);

		$err = $this->set_first_party_setting();
		if ( $err !== null ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-unijs-first-party', $err, 'error');
			return;
		}

		if ( ! $this->settings->save() ) {
			add_settings_error('kwanko-adv-messages', 'kwanko-adv-err-save', __('The settings could not be saved.', 'kwanko-adv'), 'error');
			return;
		}

		add_settings_error('kwanko-adv-messages', 'kwanko-adv-updated', __('Settings updated', 'kwanko-adv'), 'updated');

	}

	/**
	 * Set the firstPartyHost setting based on the public uniJS file.
	 *
	 * @since	1.2.0
	 *
	 * @return  mixed   The error string if there is one. null if there was no error.
	 */
	protected function set_first_party_setting() {

		if ( !$this->tags->is_unijs_enabled() ) {
			$this->settings->set('firstPartyHost', null);
			return null;
		}

		$content = $this->get_unijs_file_content();
		if ( $content === false ) {
			return __('Could not read the UniJS file from its public url', 'kwanko-adv'). ' (' . $this->tags->get_unijs_file_url(true) . ').';
		}

		$enabled = null;
		$host = null;

		// Try to read TRK_FIRST_PARTY string with double quotes
		preg_match('/TRK_FIRST_PARTY\s*:\s*"([^"]*)"/', $content, $matches);

		if ( count($matches) === 2 ) {
			$enabled = $matches[1] === '1';
		}

		// Try to read TRK_FIRST_PARTY string with single quotes
		preg_match("/TRK_FIRST_PARTY\s*:\s*'([^']*)'/", $content, $matches);

		if ( count($matches) === 2 ) {
			$enabled = $matches[1] === '1';
		}

		// Try to read TRK_HOST string with double quotes
		preg_match('/TRK_HOST\s*:\s*"([^"]*)"/', $content, $matches);

		if ( count($matches) === 2 ) {
			$host = $matches[1];
		}

		// Try to read TRK_HOST string with single quotes
		preg_match("/TRK_HOST\s*:\s*'([^']*)'/", $content, $matches);

		if ( count($matches) === 2 ) {
			$host = $matches[1];
		}

		if ( $enabled === null || $host === null ) {
			return __('Could not parse UniJS file content', 'kwanko-adv') . ' (' . $this->tags->get_unijs_file_url(true) . '). ' . __('Are you sure it is the right file ?', 'kwanko-adv');
		}

		$this->settings->set('firstPartyHost', $enabled ? $host : null);

		return null;

	}

	/**
	 * Return the content of the UniJS file.
	 * It returns false if the content could not be retrieved.
	 *
	 * @since	1.2.1
	 *
	 * @return mixed
	 */
	protected function get_unijs_file_content() {

		// The file was uploaded, check it on the file system.
		if ( $this->settings->get('uniJsFileUrl') === '' ) {
			$content = @file_get_contents($this->unijs_file_path);
			if ( $content !== false ) {
				return $content;
			}
		}

		$unijs_file_url = $this->tags->get_unijs_file_url(true);

		// Try to use file_get_contents to fetch the UniJS file from its url.
		// It does not always work for https files depending on the php configuration.
		$content = @file_get_contents($unijs_file_url);
		if ( $content !== false ) {
			return $content;
		}

		if ( !extension_loaded('curl') ) {
			return false;
		}

		// Try to use curl to fetch the UniJS file from its url.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $unijs_file_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$content = curl_exec($ch);
		curl_close($ch);

		return $content;

	}


	/**
	 * Register the plugin settings.
	 *
	 * @since	1.0.0
	 */
	protected function register_settings() {

		// unijs section
		add_settings_section(
			'kwanko-adv-form-section-unijs',
			'',
			function() {},
			'kwanko-adv'
		);

		add_settings_field(
			'kwanko-adv-form-unijs-file',
			__('UniJS File Upload', 'kwanko-adv'),
			array($this, 'settings_unijs_file'),
			'kwanko-adv',
			'kwanko-adv-form-section-unijs',
			array(
				'label_for' => 'uniJsFile',
				'class' => '',
			)
		);

		add_settings_field(
			'kwanko-adv-form-unijs-url',
			'<strong style="margin-right: 10px; color: #0073aa;">'.__('OR', 'kwanko-adv').'</strong>'.__('UniJS File URL', 'kwanko-adv'),
			array($this, 'settings_unijs_url'),
			'kwanko-adv',
			'kwanko-adv-form-section-unijs',
			array(
				'label_for' => 'uniJsFileUrl',
				'class' => '',
			)
		);

		// mclic section
		add_settings_section(
			'kwanko-adv-form-section-mclic',
			'',
			function () {},
			'kwanko-adv'
		);

		add_settings_field(
			'kwanko-adv-form-mclic',
			__('MCLIC', 'kwanko-adv'),
			array($this, 'settings_mclic'),
			'kwanko-adv',
			'kwanko-adv-form-section-mclic',
			array(
				'label_for' => 'mclic',
				'class' => '',
			)
		);

		add_settings_field(
			'kwanko-adv-form-new-cutomer-mclic',
			__('MCLIC for new customers', 'kwanko-adv'),
			array($this, 'settings_new_customer_mclic'),
			'kwanko-adv',
			'kwanko-adv-form-section-mclic',
			array(
				'label_for' => 'newCustomerMclic',
				'class' => '',
			)
		);

		// enabling section
		add_settings_section(
			'kwanko-adv-form-section-enabling',
			'',
			function () {},
			'kwanko-adv'
		);

		add_settings_field(
			'kwanko-adv-form-cpa-retargeting',
			__('Enable CPA retargeting', 'kwanko-adv'),
			array($this, 'settings_cpa_retargeting'),
			'kwanko-adv',
			'kwanko-adv-form-section-enabling',
			array(
				'label_for' => 'cpaRetargeting',
				'class' => '',
			)
		);

		add_settings_field(
			'kwanko-adv-form-email-retargeting',
			__('Enable email retargeting', 'kwanko-adv'),
			array($this, 'settings_email_retargeting'),
			'kwanko-adv',
			'kwanko-adv-form-section-enabling',
			array(
				'label_for' => 'emailRetargeting',
				'class' => '',
			)
		);

		add_settings_field(
			'kwanko-adv-form-unijs-tracking',
			__('Enable latest version of the trackers', 'kwanko-adv'),
			array($this, 'settings_unijs_tracking'),
			'kwanko-adv',
			'kwanko-adv-form-section-enabling',
			array(
				'label_for' => 'uniJsTracking',
				'class' => 'unijs-tracking-field kwanko-hidden-field',
			)
		);

		// woocommerce section
		add_settings_section(
			'kwanko-adv-form-section-woocommerce',
			'',
			function () {},
			'kwanko-adv'
		);

		add_settings_field(
			'kwanko-adv-form-product-id-type',
			__('Type of product ID', 'kwanko-adv'),
			array($this, 'settings_product_id_type'),
			'kwanko-adv',
			'kwanko-adv-form-section-woocommerce',
			array(
				'label_for' => 'productIdType',
				'class' => '',
			)
		);

	}

	/**
	 * uniJsFile input.
	 *
	 * @since	1.0.0
	 */
	public function settings_unijs_file() {

		if ( $this->settings->get('uniJsFileLastUpload') === null ) {
			$descr = __('You need to upload the UniJS file provided by kwanko.', 'kwanko-adv');
		} else {
			$descr =  __('You have already uploaded the UniJS file to', 'kwanko-adv') . ' ';
			$descr .= $this->tags->get_default_unijs_file_url(false) . '<br>';
			$descr .= __('You can update it if you want.', 'kwanko-adv');
		}

		echo '<input name="uniJsFile" type="file" id="uniJsFile" aria-describedby="uniJsFile-description" />
<p class="description" id="uniJsFile-description">'.$descr.'</p>';

}

	/**
	 * uniJsFileUrl input.
	 *
	 * @since	1.0.0
	 */
	public function settings_unijs_url() {

		$descr = __('Set this URL to use a UniJS file you have manually uploaded on your server or cdn.', 'kwanko-adv'). '<br>';
		$descr .= __('Leave this field empty to use the UniJS file uploaded with this form.', 'kwanko-adv');

		$value = isset($this->form_values['uniJsFileUrl']) ? $this->form_values['uniJsFileUrl'] : '';

		echo '<input name="uniJsFileUrl" type="text" id="uniJsFileUrl" aria-describedby="uniJsFileUrl-description" value="'.$value.'" placeholder="https://" class="regular-text" />
<p class="description" id="uniJsFileUrl-description">'.$descr.'</p>';

	}

	/**
	 * mclic input.
	 *
	 * @since	1.0.0
	 */
	public function settings_mclic() {

		$ph = __('Example: G51869F51869F11', 'kwanko-adv');
		$descr = __('The advertising campaign identifier. You can find it in the tracking url as the mclic query parameter. Example: G51869F51869F11', 'kwanko-adv');

		$value = isset($this->form_values['mclic']) ? $this->form_values['mclic'] : '';

		echo '<input name="mclic" type="text" id="mclic" aria-describedby="mclic-description" value="'.$value.'" placeholder="'.$ph.'" class="regular-text" required="required" />
<p class="description" id="mclic-description">'.$descr.'</p>';

	}

	/**
	 * newCustomerMclic input.
	 *
	 * @since	1.0.0
	 */
	public function settings_new_customer_mclic() {

		$ph = __('Example: G51869F51869F11', 'kwanko-adv');
		$descr = __('The advertising campaign identifier for a customer\'s first purchase. If not defined, the other MCLIC will be used all the time.', 'kwanko-adv');

		$value = isset($this->form_values['newCustomerMclic']) ? $this->form_values['newCustomerMclic'] : '';

		echo '<input name="newCustomerMclic" type="text" id="newCustomerMclic" aria-describedby="newCustomerMclic-description" value="'.$value.'" placeholder="'.$ph.'" class="regular-text" />
<p class="description" id="newCustomerMclic-description">'.$descr.'</p>';

	}

	/**
	 * cpaRetargeting input.
	 *
	 * @since	1.0.0
	 */
	public function settings_cpa_retargeting() {

		$descr = __('The CPA retargeting trackers are activated when a customer see the homepage, the category pages, the product page, the basket page and the confirmation page.', 'kwanko-adv');

		$enabled = isset($this->form_values['cpaRetargeting']) && $this->form_values['cpaRetargeting'];

		echo '<select name="cpaRetargeting" id="cpaRetargeting" aria-describedby="cpaRetargeting-description">
	<option value="1" '.($enabled ? 'selected' : '').'>'.__('Enabled', 'kwanko-adv').'</option>
	<option value="0" '.($enabled ? '' : 'selected').'>'.__('Disabled', 'kwanko-adv').'</option>
</select>
<p class="description" id="cpaRetargeting-description">'.$descr.'</p>';

	}

	/**
	 * emailRetargeting input.
	 *
	 * @since	1.0.0
	 */
	public function settings_email_retargeting() {

		$descr = __('The email retargeting trackers are activated when a customer see or fill the registration form.', 'kwanko-adv');

		$enabled = isset($this->form_values['emailRetargeting']) && $this->form_values['emailRetargeting'];

		echo '<select name="emailRetargeting" id="emailRetargeting" aria-describedby="emailRetargeting-description">
	<option value="1" '.($enabled ? 'selected' : '').'>'.__('Enabled', 'kwanko-adv').'</option>
	<option value="0" '.($enabled ? '' : 'selected').'>'.__('Disabled', 'kwanko-adv').'</option>
</select>
<p class="description" id="emailRetargeting-description">'.$descr.'</p>';

	}

	/**
	 * uniJsTracking input.
	 *
	 * @since	1.0.0
	 */
	public function settings_unijs_tracking() {

		$descr = __('Must be enabled to ensure the best tracking experience. Talk to your contact at Kwanko before disabling this option.', 'kwanko-adv');

		$enabled = isset($this->form_values['uniJsTracking']) && $this->form_values['uniJsTracking'];

		echo '<select name="uniJsTracking" id="uniJsTracking" aria-describedby="uniJsTracking-description">
	<option value="1" '.($enabled ? 'selected' : '').'>'.__('Enabled', 'kwanko-adv').'</option>
	<option value="0" '.($enabled ? '' : 'selected').'>'.__('Disabled', 'kwanko-adv').'</option>
</select>
<p class="description" id="uniJsTracking-description">'.$descr.'</p>';

	}

	/**
	 * productIdType input.
	 *
	 * @since	1.1.0
	 */
	public function settings_product_id_type() {

		$descr = __('Type of product ID used in the tracking. If using a SKU, ensure that all your products have one. If you are not sure, use the product ID.', 'kwanko-adv');

		$skuSelected = isset($this->form_values['productIdType']) && $this->form_values['productIdType'] === 'sku';

		echo '<select name="productIdType" id="productIdType" aria-describedby="productIdType-description">
	<option value="id" '.($skuSelected ? '' : 'selected').'>'.__('Product ID', 'kwanko-adv').'</option>
	<option value="sku" '.($skuSelected ? 'selected' : '').'>'.__('SKU', 'kwanko-adv').'</option>
</select>
<p class="description" id="productIdType-description">'.$descr.'</p>';

	}

}
