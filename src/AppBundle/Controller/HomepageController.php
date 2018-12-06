<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};
use AppBundle\Entity\Country;
use AppBundle\Repository\{Datatable,CountryRepository};

class HomepageController extends Controller
{

	const countries = 'storages/json/countries.json';
	const cities = 'http://service.fajarpunya.com/storages/json/cities_and_regions/cities/';
	const owm_uri = 'http://api.openweathermap.org/data/2.5/weather?q=';
	const owm_api_key = 'e4dbc940495a70e7deda7a4b1607102c';
	const google_api_key = 'AIzaSyDISw6DtybhRp45w3tWj1VKGSnicuv21EI';

	/**
	* @Route("/", name="homepage")
	*/
	public function index(Request $request)
	{

		// If Request from xmlHttpRequest
		if($request->isXmlHttpRequest()) {

			$draw = $request->get('draw');
			$start = $request->get('start');
			$length = $request->get('length');
			$search = $request->get('search')['value'];

			$gm = $this->doctrine()->getManager();

			$sql1 = 'SELECT * FROM countrys WHERE name LIKE "%'.$search.'%" LIMIT '.$length.' OFFSET '.$start;
			$gc1 = $gm->getConnection()->prepare($sql1);
			$gc1->execute();
			$data1 = $gc1->fetchAll();

			if(empty($search)) {
				$sql2 = 'SELECT COUNT(*) FROM countrys';
				$gc2 = $gm->getConnection()->prepare($sql2);
				$gc2->execute();
				$data2 = $gc2->fetchAll();
				$counter = $data2[0]['COUNT(*)'];
			} else {
				$counter = count($data1);
			}

			$params = [
				'_' => $request->get('_'),
				'draw' => $draw,
				'record_total' => $counter,
				'record_filtered' => $counter,
				'data' => $data1,
				'input' => [
					'columns' => [],
					'start' => $start,
					'length' => $length
				]
			];

			return Datatable::toJson($params);
		}

		return $this->render('default/index.html.twig');
	}

	/**
	* @Route("/cities", name="getcity")
	*/
	public function Cities(Request $request)
	{

		// If Request from xmlHttpRequest
		if($request->isXmlHttpRequest()) {

			$draw = $request->get('draw');
			$start = $request->get('start');
			$length = $request->get('length');
			$search = $request->get('search')['value'];

			$gm = $this->doctrine()->getManager();

			$sql1 = 'SELECT
				countrys.name as country_name,
				citys.name as city_name,
				citys.id as city_id,
				countrys.id as country_id
				FROM citys 
				INNER JOIN countrys
					ON citys.country_id=countrys.id
				WHERE citys.name
					LIKE "%'.$search.'%"
				LIMIT '.$length.' OFFSET '.$start;

			$gc1 = $gm->getConnection()->prepare($sql1);
			$gc1->execute();
			$data1 = $gc1->fetchAll();

			if(empty($search)) {
				$sql2 = 'SELECT COUNT(*) FROM citys';
				$gc2 = $gm->getConnection()->prepare($sql2);
				$gc2->execute();
				$data2 = $gc2->fetchAll();
				$counter = $data2[0]['COUNT(*)'];
			} else {
				$counter = count($data1);
			}

			$params = [
				'_' => $request->get('_'),
				'draw' => $draw,
				'record_total' => $counter,
				'record_filtered' => $counter,
				'data' => $data1,
				'input' => [
					'columns' => [],
					'start' => $start,
					'length' => $length
				]
			];

			return Datatable::toJson($params);
		}
	}

	/**
	* @Route("/export-city", name="export-city")
	*/
	public function ExportCity(Request $request)
	{
		try {
			$cleanName = str_replace(" ", "%20", $request->get('country_name'));
			$url = self::cities.$cleanName.'.json';
			$cities = json_decode(file_get_contents($url));
			$rows = [];

			foreach ($cities->cities as $i => $city) {
				$json = ['country_id' => $request->get('country_id'), 'name' =>  $city->name];
				$rows[] = '('.$json['country_id'].',"'.$json['name'].'","'.md5(json_encode($json)).'")';
			}

			$data = implode(" , ", $rows);

			$gm = $this->doctrine()->getManager();
			$sql1 = "INSERT INTO `citys`(`country_id`,`name`,`unique_key`) VALUES $data;";

			$gc1 = $gm->getConnection()->prepare($sql1);
			$gc1->execute();

			return new JsonResponse([
				'error' => 0,
				'message' => 'Successfull.'
			]);

		} catch (\Exception $e) {
			return new JsonResponse([
				'error' => 1,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	* @Route("/get-weather", name="get-weather")
	*/
  public function getWeather(Request $request)
  {
  	$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL	 			=> 	'http://api.openweathermap.org/data/2.5/weather?q='.$request->get('city_name').'&APPID='.self::owm_api_key,
			CURLOPT_RETURNTRANSFER 	=> 	1,
			CURLOPT_HEADER			=> 	0, #0 ? 1 : 0,
			CURLOPT_TIMEOUT			=> 	30,
		));

		$data 	= curl_exec($ch);
		$error 	= curl_error($ch);
		$info 	= curl_getinfo($ch);

		if($data) {
			$decode = json_decode($data);
      if($decode->cod != 404) {
        return $this->getNearby($decode);
      }
      return $data;
		} else {
			return $error;
		}
  }

  public function getNearby($request)
  {

  	$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL	 			=> 	'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$request->coord->lat.','.$request->coord->lon.'&radius=200000&type=locality&key='.self::google_api_key,
			CURLOPT_RETURNTRANSFER 	=> 	1,
			CURLOPT_HEADER					=> 	0, #0 ? 1 : 0,
			CURLOPT_TIMEOUT					=> 	30,
		));

		$data 	= curl_exec($ch);
		$error 	= curl_error($ch);
		$info 	= curl_getinfo($ch);

		if($data) {
			// return $data;
			$decode = json_decode($data);
			return $this->getWeatherByCoordinate($decode,$request);
		} else {
			return new JsonResponse($error);
		}
  }

    public function getWeatherByCoordinate($nearby_data,$request)
    {

    	$row['first'] = $request;
    	$result = $nearby_data->results;
    	for ($i=0; $i < count($result); $i++) {
  	  	$ch[$i] = curl_init();
  			curl_setopt_array($ch[$i], array(
  				CURLOPT_URL	 			=> 	'http://api.openweathermap.org/data/2.5/weather?q='.$result[$i]->name.'&APPID='.self::owm_api_key,
  				CURLOPT_RETURNTRANSFER 	=> 	1,
  				CURLOPT_HEADER			=> 	0, #0 ? 1 : 0,
  				CURLOPT_TIMEOUT			=> 	30,
  			));
    		$row['nearbys'][$i] = json_decode(curl_exec($ch[$i]));
    		curl_close($ch[$i]);
    	}

  		return new JsonResponse($row);
    }

	protected function doctrine()
	{
		return $this->getDoctrine();
	}
}
