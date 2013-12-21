<?php

if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

function gc_preauth_config() {
	$configarray = array(
		"name" => "GoGardless PreAuth Addon",
		"description" => "This addon must be used in conjunction with the GC gateway and is a way for clients to create a DD preauthorisation without an invoice",
		"version" => "1.0",
		"author" => "Impelling Solutions Ltd",
		"fields" => array(
			'show_preauth' => array (
				"FriendlyName" => "Enable PreAuth",
				"Type" => "yesno",
				"Size" => "25",
				"Description" => "Allow clients to preauthorise without an invoice?",
			),
			'merchant_id' => array(
				'FriendlyName' => 'Merchant ID',
				'Type' => 'text',
				'Size' => '15',
				'Description' => '<a href="http://gocardless.com/merchants/new" target="_blank">Sign up</a> for a GoCardless account then find your API keys in the Developer tab. Use the same details here as you enter into the actual payment gateway'
			),
			'app_id' => array(
				'FriendlyName' => 'App ID',
				'Type' => 'text',
				'Size' => '100'
			),
			'app_secret' => array(
				'FriendlyName' => 'App Secret',
				'Type' => 'text',
				'Size' => '100'
			),
			'access_token' => array(
				'FriendlyName' => 'Access Token',
				'Type' => 'text',
				'Size' => '100'
			),
			'test_mode' => array(
				'FriendlyName' => 'Sandbox Mode',
				'Type' => 'yesno',
				'Description' => 'Tick to enable the GoCardless sandbox environment where real payments will not be taken. You will need to have set the specific sandbox keys below.'
			),
			'dev_merchant_id' => array(
				'FriendlyName' => 'Sandbox Merchant ID',
				'Type' => 'text',
				'Size' => '15',
				'Description' => 'Use your GoCardless login details to access the <a href="http://sandbox.gocardless.com/" target="_blank">Sandbox</a> and then find your API keys in the Developer tab'
			),
			'dev_app_id' => array(
				'FriendlyName' => 'Sandbox App ID',
				'Type' => 'text',
				'Size' => '100'
			),
			'dev_app_secret' => array(
				'FriendlyName' => 'Sandbox App Secret',
				'Type' => 'text',
				'Size' => '100'
			),
			'dev_access_token' => array(
				'FriendlyName' => 'Sandbox Access Token',
				'Type' => 'text',
				'Size' => '100'
			),
		));
	return $configarray;
}

/**
 * Activation of the gc preauth addon, with db creation etc
 */
function gc_preauth_activate()
{
	//db creation just in case the gateway hasn't been activated yet
	gc_preauth_createdb();
}


/**
 * Client area output for the preauth configuration...
 */
function gc_preauth_clientarea($params)
{

	require_once ROOTDIR . '/modules/gateways/gocardless.php';
	require_once ROOTDIR . '/modules/gateways/gocardless/GoCardless.php';

	// initialise GC
	gocardless_set_account_details($params);

	$return = array(
		'pagetitle' => 'Direct Debit Preauthorisation',
		'templatefile' => 'gc_preauth',
		'requirelogin' => true,
		'params' => $params,
	);
	return $return;

}



/**
 ** Create mod_gocardless_client_preauth table if it does not already exist
 **/
function gc_preauth_createdb() {

	if(mysql_num_rows(full_query("SHOW TABLES LIKE 'mod_gocardless_client_preauth'"))) {
	}
	else
	{
		# create the table if it doesn't exist
		$query = "CREATE TABLE IF NOT EXISTS `mod_gocardless_client_preauth` (
            `id` int(11) NOT NULL auto_increment,
            `client_id` int(11) NOT NULL,
            `preauth_id` varchar(16) default NULL,
            `active` tinyint(1) NOT NULL default '1',
            PRIMARY KEY  (`id`),
            UNIQUE KEY `client_id` (`client_id`),
            UNIQUE KEY `preauth_id` (`preauth_id`))";

		full_query($query);
	}
}