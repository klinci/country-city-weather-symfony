<?php

namespace WeatherBundle\Manager;

/**
* Class WeatherManager
*
* @package WeatherBunlde\Manager
*/
class WeatherManager
{

	/**
	* @var string
	*/
	protected $apikey;

	/**
	* @var string
	*/
	protected $url;

	public function __construct($apikey,$url)
	{
		$this->apikey = $apikey;
		$this->url 		= $url;
	}

	public function getWeather($param)
	{
  	$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $this->url.$param.'&APPID='.$this->apikey,
			CURLOPT_RETURNTRANSFER 	=> 	1,
			CURLOPT_HEADER => 	0, #0 ? 1 : 0,
			CURLOPT_TIMEOUT => 	30,
		));

		$data 	= curl_exec($ch);
		$error 	= curl_error($ch);
		$info 	= curl_getinfo($ch);

		curl_close($ch);

		if($data) {
			return $data;
		} else {
			return $error;
		}
	}

}