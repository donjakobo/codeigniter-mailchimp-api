<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 	Super-simple, minimum abstraction MailChimp API v2 wrapper
 * 	Forked initially from:
 *		Drew McLellan <drew.mclellan@gmail.com>
 *		https://github.com/drewm/mailchimp-api	v1.0
 *
 */
class mailchimp_api
{
	var $CI;	// CI instance
	
	private $api_key;
	private $api_endpoint = 'https://<dc>.api.mailchimp.com/2.0/';

	/**
	 * Create a new instance
	 * @param string $api_key Your MailChimp API key
	 */
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->config( 'mailchimp' );		// load config file to get mailchimp credentials
		$this->api_key = $this->CI->config->item('apikey');
		
		list(, $datacentre) = explode('-', $this->api_key);
		$this->api_endpoint = str_replace('<dc>', $datacentre, $this->api_endpoint);
	}

	/**
	 * Call an API method. Every request needs the API key, so that is added automatically -- you don't need to pass it in.
	 * @param  string $method The API method to call, e.g. 'lists/list'
	 * @param  array  $args   An array of arguments to pass to the method. Will be json-encoded for you.
	 * @return array          Associative array of json decoded API response.
	 */
	public function call($method, $args=array())
	{
		return $this->_raw_request($method, $args);
	}

	/**
	 * Performs the underlying HTTP request. Not very exciting
	 * @param  string $method The API method to be called
	 * @param  array  $args   Assoc array of parameters to be passed
	 * @return array          Assoc array of decoded result
	 */
	private function _raw_request($method, $args=array())
	{      
		$args['apikey'] = $this->api_key;

		$url = $this->api_endpoint.'/'.$method.'.json';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_USERAGENT, 'MCAPI/2.0');		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args));
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result ? json_decode($result, true) : false;
	}

}