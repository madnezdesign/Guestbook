<?php

error_reporting(-1);
ini_set('display_errors', 1);

/**
 * Set what to show as debug or developer information in the get_debug() theme helper.
 */
 
$ml->config['debug']['mad'] = false;
$ml->config['debug']['session'] = false;
$ml->config['debug']['timer'] = true;
$ml->config['debug']['db-num-queries'] = true;
$ml->config['debug']['db-queries'] = true;

/**
 * Set database(s).
 */
 
$ml->config['database'][0]['dsn'] = 'sqlite:' . MAD_SITE_PATH . '/data/.ht.sqlite';

/**
 * What type of urls should be used?
 * 
 * default      = 0      => index.php/controller/method/arg1/arg2/arg3
 * clean        = 1      => controller/method/arg1/arg2/arg3
 * querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
 */
 
$ml->config['url_type'] = 1;

/**
 * Set a base_url to use another than the default calculated
 */
 
$ml->config['base_url'] = null;

/**
 * Define session name
 */
 
$ml->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);
$ml->config['session_key']  = 'mad';

/**
 * Define server timezone
 */
 
$ml->config['timezone'] = 'Europe/Stockholm';

/**
 * Define internal character encoding
 */
 
$ml->config['character_encoding'] = 'UTF-8';

/**
 * Define language
 */
 
$ml->config['language'] = 'sv';

/**
 * Define the controllers, their classname and enable/disable them.
 *
 * The array-key is matched against the url, for example: 
 * the url 'developer/dump' would instantiate the controller with the key "developer", that is 
 * CCDeveloper and call the method "dump" in that class. This process is managed in:
 * $ml->FrontControllerRoute();
 * which is called in the frontcontroller phase from index.php.
 */
 
$ml->config['controllers'] = array(
  'index'     => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true,'class' => 'CCDeveloper'),
  'guestbook' => array('enabled' => true,'class' => 'CCGuestbook'),
);

/**
 * Settings for the theme.
 */
 
$ml->config['theme'] = array(
  // The name of the theme in the theme directory
  'name'    => 'core', 
);