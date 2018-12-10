<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Country;
use Symfony\Component\HttpFoundation\{
	Request,
	Response,
	JsonResponse
};
use AppBundle\Services\{
	ResponseWriterService,
	Datatable
};

class HomepageController extends Controller
{

	const countries = 'storages/json/countries.json';
	const cities = 'http://service.fajarpunya.com/storages/json/cities_and_regions/cities/';

	public function __construct() {
		$this->write = new ResponseWriterService();
	}

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

			return $this->write->success('Successfull.');

		} catch (\Exception $e) {
			return $this->write->error($e->getMessage());
		}
	}

	/**
	* @Route("/get-weather", name="get-weather")
	*/
  public function getWeather(Request $request)
  {

  	try {

  		/*
  		* Call Wheater Manager Services
  		*/
  		$wm = $this->get('WeatherManager');
  		/*
  		* Call google Map API Service
  		*/
  		$gmap = $this->get('GoogleMapApiManager');
  		/*
  		* Get Weather
  		*/
  		$owmResponse = $wm->getWeather($request->get('city_name'));
  		$weatherResponse = json_decode($owmResponse);

  		if($weatherResponse->cod != 404) {
  			$nearbyResponse = $gmap->getNearby($weatherResponse);
  			$nearbyResponseDecode = json_decode($nearbyResponse);

  			$row['first'] = $weatherResponse;
  			$result = $nearbyResponseDecode->results;
  			for ($i=0; $i < count($result); $i++) {
  				$owmResonse = $wm->getWeather($result[$i]->name);
  				$row['nearbys'][$i] = json_decode($owmResonse);
  			}
  			return new JsonResponse($row);
  		} else {
  			return $this->write->error('City not found.');
  		}

  	} catch (\Exception $e) {
  		
  	}

  	return new Response($owmResponse);
  }

	/**
	* @Route("/get-test", name="get-test")
	*/
  public function getTest() {
  	// return new Response(
  	// 	$this->get('weather.example')
  	// );
  	$wm = $this->get('WeatherManager');
  	return new Response($wm->getWeather('param'));
  }

	protected function doctrine()
	{
		return $this->getDoctrine();
	}
}
