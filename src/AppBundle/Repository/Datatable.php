<?php

namespace AppBundle\Repository;
use Symfony\Component\HttpFoundation\JsonResponse;

class Datatable
{
	public static function toJson($params)
	{
		/*
		* 	This for show record total
		*/
		if(isset($params['record_total'])) {
			$attributes['recordsTotal'] = $params['record_total'];
		}
		/*
		* 	This for show record total filtered
		*/
		if(isset($params['record_filtered'])) {
			$attributes['recordsFiltered'] = $params['record_filtered'];
		}
		/*
		* 	This for show all data response from database
		*/
		if(isset($params['data'])) {
			$attributes['data'] = $params['data'];
		}
		/*
		* 	This for draw
		*/
		if(isset($params['draw'])) {
			/*
			* 	This for draw
			*/
			$attributes['draw'] = $params['draw'];
			$attributes['input']['draw'] = $attributes['draw'];
			/*
			* 	This for columns responses
			*/
			if(isset($params['input']['columns'])) {
				$attributes['input']['columns'] = $params['input']['columns'];
			}
			/*
			* 	This for paging where start from page
			*/
			if(isset($params['input']['start'])) {
				$attributes['input']['start'] = $params['input']['start'];
			}
			/*
			* 	This for paging where limit show data
			*/
			if(isset($params['input']['length'])) {
				$attributes['input']['length'] = $params['input']['length'];
			}
			/*
			* 	_
			*/
			if(isset($params['_'])) {
				$attributes['_'] = $params['_'];
			}

		}
		/*
		* 	Return with JSON Response
		*/
		return new JsonResponse($attributes);
	}
}