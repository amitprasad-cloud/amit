<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

/**
 * Zend Framework Loader
 *
 * Put the 'Zend' folder (unpacked from the Zend Framework package, under 'Library')
 * in CI installation's 'application/libraries' folder
 * You can put it elsewhere but remember to alter the script accordingly
 *
 * Usage:
 *   1) $this->load->library('zend', 'Zend/Package/Name');
 *   or
 *   2) $this->load->library('zend');
 *      then $this->zend->load('Zend/Package/Name');
 *
 * * the second usage is useful for autoloading the Zend Framework library
 * * Zend/Package/Name does not need the '.php' at the end
 */
class Sendgrid
{
    /**
     * This file is used to load the Composer autoloader if required.
     */

    function __construct()

    {

        parent::__construct();
        $this->load->library('session');


    }

    use SendGrid\Mail\Mail;

    // Define path/existence of Composer autoloader
    //$composerAutoloadFile = __DIR__ . '/vendor/autoload.php';
    $composerAutoloadFile = base_url().'applications/libraries/sendgrid/vendor/autoload.php');
    //$composerAutoloadFile = APPPATH.'applications/proyect/libraries/PHPExcel/Cell/AdvancedValueBinder.php'
    $composerAutoloadFileExists = (is_file($composerAutoloadFile));

    // Can't locate SendGrid\Mail\Mail class?
    if (!class_exists(Mail::class)) {
        // Suggest to load Composer autoloader of project
        if (!$composerAutoloadFileExists) {
            //  Can't load the Composer autoloader in this project folder
            error_log("Composer autoloader not found. Execute 'composer install' in the project folder first.");
        } else {
            // Load Composer autoloader
            require_once $composerAutoloadFile;

            // If desired class still not existing
            if (!class_exists(Mail::class)) {
                // Suggest to review the Composer autoloader settings
                error_log("Error finding SendGrid classes. Please review your autoloading configuration.");
            }
        }
    }
}
