<?php
namespace STI\SemantifyIt\Domain\Model;

use \STI\SemantifyIt\SemantifyIt;

require_once(__DIR__ . "/../../Vendor/semantify-api-php/SemantifyIt.php");


/**
 * Class SemantifyItWrapper
 */
class SemantifyItWrapper extends SemantifyIt
{

    /**
     * SemantifyItWrapper constructor.
     *
     * @param string $key
     */
    public function __construct($key = "", $secret = "")
    {
        $development = array("sti.dev", "staging.semantify.it", "demo.semantify.it");

        //switch to stagging server if it is on the development server
        if(in_array($_SERVER['HTTP_HOST'],$development)) {
            $this->setLive(true);
            $this->setError(true);
        }

        if ($key != "") {
            $this->setWebsiteApiKey($key);
            if ($secret != "") {
                $this->setWebsiteApiSecret($secret);
            }
            return;
        }


        $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['semantify_it']);
        $websiteApiKey = $confArray['smtf.']['WebsiteApiKey'];
        $websiteApiSecret = $confArray['smtf.']['WebsiteApiSecret'];

        $this->setWebsiteApiKey($websiteApiKey);
        $this->setWebsiteApiSecret($websiteApiSecret);
    }

}