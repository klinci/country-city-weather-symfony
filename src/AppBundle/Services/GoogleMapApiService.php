<?php

namespace AppBundle\Services;

class GoogleMapApiService
{

	const google_api_url = 'https://maps.googleapis.com/';
	const path = 'maps/api/place/nearbysearch/json?location=';
	const google_api_key = 'AIzaSyDISw6DtybhRp45w3tWj1VKGSnicuv21EI';
	const radius = 50000;
	const type = 'locality';

	public function getNearby($param)
	{
  	$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL	 			=> 	self::google_api_url.self::path.$param->coord->lat.','.$param->coord->lon.'&radius='.self::radius.'&type='.self::type.'&key='.self::google_api_key,
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