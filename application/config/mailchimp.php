<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *	MailChimp v2.0 API - https://github.com/donjakobo/codeigniter-mailchimp-api
 * 	This is the config file for the Library, find your API Key and List ID via the mailchimp website.
 */

/**
 *	Your API KEY generated by mailChimp
 */
$config['apikey'] = '';

/**
 *	Use a secure SSL connection for connection?
 */
$config['secure'] = TRUE;	// default TRUE

/**
 *	ID of the List you wish to update / check (only 1 is supported right now by this code).
 */
$config['list_id'] = '';		// your LIST ID (found via list details, unique ID)

/**
 *	ID of the Grouping you wish to add groups to (only 1 is supported right now by this code)
 */
$config['list_grouping_id'] = '';		// your grouping id (from mailchimp, ie: Hobbies under your List)


