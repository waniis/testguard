<?php
namespace WPSynchro\Masterdata;

use WPSynchro\Transport\Destination;
use WPSynchro\Transport\RemoteTransport;

/**
 * Retrives masterdata retrival
 * @since 1.6.0
 */
class MasterdataRetrieval
{
    public $data_to_retrieve = [];
    // Request security (optional)
    public $token = null;
    public $encryption_key = null;
    // Data retrieved
    public $data = [];

    const REST_PATH = "/wp-json/wpsynchro/v1/masterdata/";

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }

    /**
     *  Set the data to retrieve
     *  @since 1.6.0
     */
    public function setDataToRetrieve($data_arr)
    {
        $this->data_to_retrieve = $data_arr;
    }

    /**
     *  Set token on request (optional)
     *  @since 1.6.0
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     *  Set encryption key on request (optional)
     *  @since 1.6.0
     */
    public function setEncryptionKey($key)
    {
        $this->encryption_key = $key;
    }

    /**
     *  Get masterdata
     *  @since 1.6.0
     */
    public function getMasterdata()
    {

        // Generate query string
        $querystring = "";
        foreach ($this->data_to_retrieve as $slug) {
            $querystring .= "&type[]=" . $slug;
        }
        $querystring = trim($querystring, "&");

        // Get url
        $url = $this->destination->getFullURL(self::REST_PATH) . '?' . $querystring;

        // Get remote transfer object
        $remotetransport = new RemoteTransport();
        $remotetransport->setDestination($this->destination);
        $remotetransport->init();
        $remotetransport->setUrl($url);

        // Check for specific token and encryption key
        if (!is_null($this->token) && !is_null($this->encryption_key)) {
            $remotetransport->setToken($this->token);
            $remotetransport->setEncryptionKey($this->encryption_key);
        }

        // Execute request
        $transportresult = $remotetransport->remotePOST();

        // Handle result
        if ($transportresult->isSuccess()) {
            $this->data = $transportresult->getBody();
            return true;
        } else {
            return false;
        }
    }
}
