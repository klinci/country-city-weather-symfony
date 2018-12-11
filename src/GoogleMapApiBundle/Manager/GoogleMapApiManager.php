<?php

namespace GoogleMapApiBundle\Manager;

/**
* Class GoogleMapApiManager
*
* @package GoogleMapApiBundle\Manager
*/
class GoogleMapApiManager
{
	/**
	* @var string
	*/
	private $google_apikey;
	/**
	* @var string
	*/
	private $google_url;
	/**
	* @var string
	*/
	private $google_radius;
	/**
	* @var string
	*/
	private $google_type;

	public function __construct($google_apikey,$google_url,$google_radius,$google_type)
	{
		$this->apikey = $google_apikey;
		$this->url = $google_url;
		$this->radius = $google_radius;
		$this->type = $google_type;
	}

	public function getNearby($param)
	{

  	$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL	 			=> 	$this->url.$param->coord->lat.','.$param->coord->lon.'&radius='.$this->radius.'&type='.$this->type.'&key='.$this->apikey,
			CURLOPT_RETURNTRANSFER 	=> 	1,
			CURLOPT_HEADER					=> 	0, #0 ? 1 : 0,
			CURLOPT_TIMEOUT					=> 	30,
		));

		$data 	= curl_exec($ch);
		$error 	= curl_error($ch);
		$info 	= curl_getinfo($ch);

		if($data) {
			return $data;
		} else {
			return $error;
		}

	}

}