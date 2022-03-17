<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link	https://www.kwanko.com
 * @since	1.0.0
 *
 * @package		Kwanko_Adv
 * @subpackage	Kwanko_Adv/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package		Kwanko_Adv
 * @subpackage	Kwanko_Adv/public
 * @author		Kwanko <support@kwanko.com>
 */
class Kwanko_Adv_Public {

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
	protected $need_lead_inscription_tag = false;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param	string	$plugin_name	   The name of the plugin.
	 * @param 	string	$version	The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		try {
			// set dependencies
			$this->settings = new Kwanko_Adv_Settings();
			$this->settings->load();

			$this->tags = new Kwanko_Adv_Tags($this->settings);

		} catch (\Exception $e) {}

	}

	/**
	 * Save the lead in the database when a new user is created.
	 *
	 * @since	1.0.0
	 */
	public function user_register($user_id) {

		try {
			if ( ! $this->settings->get('emailRetargeting') ) {
				return;
			}

			update_option('kwanko-adv-lead', $user_id);

		} catch (\Exception $e) {}

	}

	/**
	 * Save the lead in the database when a new user is created.
	 *
	 * @since	1.0.0
	 */
	public function woocommerce_register_form($user_id) {

		try {
			if ( $this->settings->get('emailRetargeting') ) {
				$this->need_lead_inscription_tag = true;
			}

		} catch (\Exception $e) {}

	}

	/**
	 * Print some code in the header.
	 *
	 * @since	1.0.0
	 */
	public function add_to_header() {

		try {
			echo '<!-- kwanko - header ' . $this->tags->get_config_code() . ' -->';

			if ( $this->tags->is_unijs_enabled() ) {
				echo '<script type="text/javascript" src="' . $this->tags->get_unijs_file_url() . '"></script>';
			}

		} catch (\Exception $e) {
			echo '<!-- kwanko - header exception -->';
		}

	}

	/**
	 * Print some code in the footer.
	 *
	 * @since	1.0.0
	 */
	public function add_to_footer() {

		try {
			echo '<!-- kwanko - footer -->';

			if ( ! $this->tags->is_configured() ) {
				return;
			}

			// first, try to track a conversion
			if ( is_wc_endpoint_url('order-received') ) {
				echo $this->tags->conversion_tag();

				if ( $this->settings->get('cpaRetargeting') ) {
					echo $this->tags->ptag_transaction();
				}

				return;
			}

			// "lead_confirmation" is the most important tag after the "transaction" tag.
			$lead_id = get_option('kwanko-adv-lead');

			if ( $this->settings->get('emailRetargeting') && $lead_id ) {
				$tag = $this->tags->lead_confirmation($lead_id);
				echo $tag;

				// ensure that the tag has been displayed before removing the "kwanko-adv-lead" option
				if ( $tag !== '' ) {
					delete_option('kwanko-adv-lead');
				}

				return;
			}

			// other cpa retargeting tags
			if ( $this->settings->get('cpaRetargeting') ) {
				if ( is_front_page() ) {
					echo $this->tags->ptag_homepage();
					return;
				}

				if ( is_product() ) {
					echo $this->tags->ptag_product();
					return;
				}

				if ( is_product_category() ) {
					echo $this->tags->ptag_category();
					return;
				}

				if ( is_cart() || is_checkout() ) {
					echo $this->tags->ptag_basket();
					return;
				}
			}

			// "lead_inscription" is less important than "basket"
			// It means that it does not work in the checkout process.
			if ( $this->settings->get('emailRetargeting') && $this->need_lead_inscription_tag ) {
				echo $this->tags->lead_inscription();
				return;
			}

		} catch (\Exception $e) {
			echo '<!-- kwanko - footer exception -->';
		}

	}

}
