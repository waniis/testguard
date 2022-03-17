<?php

class LpcUpdate extends LpcComponent {
    const LPC_DB_VERSION_OPTION_NAME = 'lpc_db_version';

    // const for 1.3 updates
    const LPC_ORDERS_TO_MIGRATE_OPTION_NAME = 'lpc_migration13_orders_to_migrate';
    const LPC_MIGRATION13_HOOK_NAME = 'lpcMigrationHook13';
    const LPC_MIGRATION13_DONE_OPTION_NAME = 'lpc_migration13_done';

    /** @var LpcCapabilitiesPerCountry */
    protected $capabilitiesPerCountry;
    /** @var LpcDbDefinition */
    protected $dbDefinition;
    /** @var LpcOutwardLabelDb */
    protected $outwardLabelDb;
    /** @var LpcInwardLabelDb */
    protected $inwardLabelDb;
    /** @var LpcAdminNotices */
    protected $adminNotices;
    /** @var LpcShippingZones */
    protected $shippingZones;

    public function __construct(
        LpcCapabilitiesPerCountry $capabilitiesPerCountry = null,
        LpcDbDefinition $dbDefinition = null,
        LpcOutwardLabelDb $outwardLabelDb = null,
        LpcInwardLabelDb $inwardLabelDb = null,
        LpcAdminNotices $adminNotices = null,
        LpcShippingZones $shippingZones = null
    ) {
        $this->capabilitiesPerCountry = LpcRegister::get('capabilitiesPerCountry', $capabilitiesPerCountry);
        $this->dbDefinition           = LpcRegister::get('dbDefinition', $dbDefinition);
        $this->outwardLabelDb         = LpcRegister::get('outwardLabelDb', $outwardLabelDb);
        $this->inwardLabelDb          = LpcRegister::get('inwardLabelDb', $inwardLabelDb);
        $this->adminNotices           = LpcRegister::get('lpcAdminNotices', $adminNotices);
        $this->shippingZones          = LpcRegister::get('shippingZones', $shippingZones);
    }

    public function getDependencies() {
        return ['capabilitiesPerCountry', 'dbDefinition', 'outwardLabelDb', 'inwardLabelDb', 'lpcAdminNotices'];
    }

    public function init() {
        add_action(self::LPC_MIGRATION13_HOOK_NAME, [$this, 'doMigration13']);
        add_action('wp_loaded', [$this, 'update']);
        add_filter('cron_schedules', [$this, 'addCronIntervals']);
    }

    public function addCronIntervals($schedules) {
        $schedules['fifteen_seconds'] = [
            'interval' => 15,
            'display'  => __('Every Fifteen Seconds'),
        ];

        return $schedules;
    }

    public function update() {
        if (is_multisite()) {
            global $wpdb;

            foreach ($wpdb->get_col("SELECT blog_id FROM $wpdb->blogs") as $blog_id) {
                switch_to_blog($blog_id);
                $lpcVersionInstalled = get_option(self::LPC_DB_VERSION_OPTION_NAME, LPC_VERSION);
                $this->runUpdate($lpcVersionInstalled);
                update_option(self::LPC_DB_VERSION_OPTION_NAME, LPC_VERSION);
                restore_current_blog();
            }
        } else {
            $lpcVersionInstalled = LpcHelper::get_option(self::LPC_DB_VERSION_OPTION_NAME, LPC_VERSION);
            $this->runUpdate($lpcVersionInstalled);
            update_option(self::LPC_DB_VERSION_OPTION_NAME, LPC_VERSION);
        }
    }

    protected function runUpdate($versionInstalled) {
        if (LpcHelper::get_option(self::LPC_MIGRATION13_DONE_OPTION_NAME, false) !== false) {
            $this->adminNotices->add_notice(
                'label_migration',
                'notice-success',
                __('Colissimo Official plugin: the labels migration is done!', 'wc_colissimo')
            );

            delete_option(self::LPC_MIGRATION13_DONE_OPTION_NAME);
        }

        // Update from version under 1.3
        if (version_compare($versionInstalled, '1.3') === - 1) {
            $this->capabilitiesPerCountry->saveCapabilitiesPerCountryInDatabase();
            $this->dbDefinition->defineTableLabel();
            $this->handleMigration13();
        }

        // Update from version under 1.5
        if (version_compare($versionInstalled, '1.5') === - 1) {
            $this->capabilitiesPerCountry->saveCapabilitiesPerCountryInDatabase();
            $this->shippingZones->addCustomZonesOrUpdateOne('France');
        }

        // Update from version under 1.6
        if (version_compare($versionInstalled, '1.6') === - 1) {
            $currentlpc_email_outward_tracking = LpcHelper::get_option(LpcOutwardLabelEmailManager::EMAIL_OUTWARD_TRACKING_OPTION, 'no');

            if ('yes' === $currentlpc_email_outward_tracking) {
                $newlpc_email_outward_tracking = LpcOutwardLabelEmailManager::ON_OUTWARD_LABEL_GENERATION_OPTION;
            } else {
                $newlpc_email_outward_tracking = 'no';
            }

            update_option(LpcOutwardLabelEmailManager::EMAIL_OUTWARD_TRACKING_OPTION, $newlpc_email_outward_tracking);
        }
    }

    /** Functions for update to 1.3 **/
    protected function handleMigration13() {
        $this->adminNotices->add_notice(
            'label_migration',
            'notice-success',
            sprintf(
                __(
                    'Thanks for updating Colissimo Official plugin to version %s. This version needs to modify the database structure and it will take a few minutes. While the migration is being done, you can use the plugin as usual but you won\'t be able to see the labels in the Colissimo listing. Please contact the Colissimo support if they are still not visible in a few hours.',
                    'wc_colissimo'
                ),
                LPC_VERSION
            )
        );

        // If we have to retry the migration, we don't erase orders ids to migrate
        if (!LpcHelper::get_option(self::LPC_ORDERS_TO_MIGRATE_OPTION_NAME, false)) {
            $orderIdsToMigrate = $this->outwardLabelDb->getOldTableOrdersToMigrate();
            update_option(self::LPC_ORDERS_TO_MIGRATE_OPTION_NAME, json_encode($orderIdsToMigrate));
        }

        if (!wp_next_scheduled(self::LPC_MIGRATION13_HOOK_NAME)) {
            wp_schedule_event(time(), 'fifteen_seconds', self::LPC_MIGRATION13_HOOK_NAME);
        }
    }

    public function doMigration13() {
        $orderIdsToMigrate = json_decode(LpcHelper::get_option(self::LPC_ORDERS_TO_MIGRATE_OPTION_NAME));

        if (0 === count($orderIdsToMigrate)) {
            $timestamp = wp_next_scheduled(self::LPC_MIGRATION13_HOOK_NAME);
            wp_unschedule_event($timestamp, self::LPC_MIGRATION13_HOOK_NAME);
            delete_option(self::LPC_ORDERS_TO_MIGRATE_OPTION_NAME);
            update_option(self::LPC_MIGRATION13_DONE_OPTION_NAME, 1);

            return;
        }

        $orderIdsToMigrateForCurrentBatch = array_splice($orderIdsToMigrate, 0, 5);

        if (
            $this->outwardLabelDb->migrateDataFromLabelTableForOrderIds($orderIdsToMigrateForCurrentBatch)
            && $this->inwardLabelDb->migrateDataFromLabelTableForOrderIds($orderIdsToMigrateForCurrentBatch)
        ) {
            update_option(self::LPC_ORDERS_TO_MIGRATE_OPTION_NAME, json_encode($orderIdsToMigrate));
        }
    }
}
