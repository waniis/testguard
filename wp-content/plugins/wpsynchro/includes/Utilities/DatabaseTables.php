<?php

namespace WPSynchro\Utilities;

/**
 * Class for creating database tables
 * @since 1.5.0
 */
class DatabaseTables
{
    // Table names
    const SYNC_LIST = "wpsynchro_sync_list";
    const FILE_POPULATION = "wpsynchro_file_population_list";
    // Charset and collation
    private $charset = "";
    private $collation = "";

    /**
     * Constructor
     * @since 1.7.0
     */
    public function __construct()
    {
        global $wpdb;
        // Get best charset and collation
        $charset_and_collation = $wpdb->determine_charset('utf8', 'utf8_general_ci');
        $this->charset = $charset_and_collation['charset'];
        $this->collation = $charset_and_collation['collate'];
    }

    /**
     *  Create sync list db table if not exists
     *  @since 1.2.0
     */
    public function createSyncListTable()
    {
        global $wpdb;
        $tablename = $wpdb->prefix . self::SYNC_LIST;
        // Delete the table
        $wpdb->query("drop table if exists `" . $tablename . "`");

        // Create it again
        $wpsynchro_synclist_sql = "CREATE TABLE $tablename (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                origin varchar(10) DEFAULT NULL,
                section varchar(32) DEFAULT NULL,
                source_file varchar(4100) DEFAULT NULL,
                is_dir tinyint(1) DEFAULT 0,
                size bigint(20) DEFAULT NULL,
                hash varchar(32) DEFAULT NULL,
                is_partial tinyint(1) DEFAULT 0,
                partial_position bigint(20) DEFAULT 0,
                needs_transfer_hash varchar(32) DEFAULT NULL,
                needs_delete_hash varchar(32) DEFAULT NULL,
                needs_transfer tinyint(1) DEFAULT 0,
                needs_delete tinyint(1) DEFAULT 0,
                PRIMARY KEY  (id),
                KEY origin (origin),
                KEY section (section),
                KEY needs_transfer_hash (needs_transfer_hash),
                KEY needs_delete_hash (needs_delete_hash),
                KEY is_dir (is_dir)
            ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=" . $this->charset . " COLLATE=" . $this->collation . ";";



        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($wpsynchro_synclist_sql);

        // Check that it is created
        $is_created_result = $wpdb->query("show tables like '" . $tablename . "'");
        if (!$is_created_result || $is_created_result !== 1) {
            return false;
        }
        return true;
    }

    /**
     * Reset file population table
     * @since 1.4.0
     */
    public function createFilePopulationTable()
    {
        global $wpdb;
        $tablename = $wpdb->prefix . self::FILE_POPULATION;
        // Delete the table
        $wpdb->query("drop table if exists `" . $tablename . "`");

        // Create it again
        $wpsynchro_filepopulation_sql = "CREATE TABLE $tablename (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                source_file varchar(4100) DEFAULT NULL,
                hash varchar(32) DEFAULT NULL,
                is_expanded tinyint(1) DEFAULT 0,
                is_dir tinyint(1) DEFAULT 0,
                size bigint(20) DEFAULT NULL,
                PRIMARY KEY  (id)
            ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=" . $this->charset . " COLLATE=" . $this->collation . ";";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($wpsynchro_filepopulation_sql);

        // Check that it is created
        $is_created_result = $wpdb->query("show tables like '" . $tablename . "'");
        if (!$is_created_result || $is_created_result !== 1) {
            return false;
        }
        return true;
    }
}
