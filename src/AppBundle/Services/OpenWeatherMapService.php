<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Response;

class OpenWeatherMapService
{

	const owm_uri = 'http://api.openweathermap.org/data/2.5/weather?q=';
	const owm_api_key = 'e4dbc940495a70e7deda7a4b1607102c';

	public function getWeather($param)
	{
  	$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => self::owm_uri.$param.'&APPID='.self::owm_api_key,
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