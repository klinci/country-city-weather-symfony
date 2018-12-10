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
	protected $apikey;
	/**
	* @var string
	*/
	protected $url;
	/**
	* @var string
	*/
	protected $radius;
	/**
	* @var string
	*/
	protected $type;

	public function __construct($apikey,$url,$radius,$type)
	{
		$this->apikey = $apikey;
		$this->url = $url;
		$this->radius = $radius;
		$this->type = $type;
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