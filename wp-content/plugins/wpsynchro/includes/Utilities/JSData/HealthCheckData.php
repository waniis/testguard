<?php

/**
 * Class for providing data for Health check JS
 * @since 1.6.0
 */

namespace WPSynchro\Utilities\JSData;

use WPSynchro\CommonFunctions;

class HealthCheckData
{

    /**
     *  Load the JS data for Health Check Vue component
     */
    public function load()
    {
        $commonfunctions = new CommonFunctions();

        $healthcheck_localize = [
            'rest_nonce' => wp_create_nonce('wp_rest'),
            'basic_check_resturl' => get_rest_url(get_current_blog_id(), 'wpsynchro/v1/healthcheck/'),
            'introtext' => __('Health check for WP Synchro', 'wpsynchro'),
            'helptitle' => __('Check if this site will work with WP Synchro. It checks REST access, php extensions, hosting setup and more.', 'wpsynchro'),
            'basic_check_desc' => __('Performing basic health check', 'wpsynchro'),
            'errorsfound' => __('Errors found', 'wpsynchro'),
            'warningsfound' => __('Warnings found', 'wpsynchro'),
            'rerunhelp' => __("Tip: These tests can be rerun in 'Support' menu.", 'wpsynchro'),
            'errorunknown' => __('Critical - Request to local WP Synchro health check REST service could not be sent or did not get no response.', 'wpsynchro'),
            'errornoresponse' => __('Critical - Request to local WP Synchro health check REST service did not get a response at all.', 'wpsynchro'),
            'errorwithstatuscode' => __('Critical - Request to REST service did not respond properly - HTTP {0} - Maybe REST is blocked or returns invalid content. Response JSON:', 'wpsynchro'),
            'errorwithoutstatuscode' => __('Critical - Request to REST service did not respond properly - Maybe REST is blocked or returns invalid content. Response JSON:', 'wpsynchro'),
        ];
        wp_localize_script('wpsynchro_admin_js', 'wpsynchro_healthcheck', $healthcheck_localize);
    }
}
