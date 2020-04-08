<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Log;

class CarController extends Controller
{
	public function list()
	{
		$url = 'http://157.230.213.199:3000/api/cars';
		$JSON = file_get_contents($url);
		return response()->json(json_decode($JSON));
	}

	public function create()
	{
		$url = 'http://157.230.213.199:3000/api/cars';

		$data = array(
			'title' => 'a3 sportback',
			'brand' => 'audi',
			'price' => 87000,
			'age' => 2018
		);

		$options = array(
			'http' => array(
				'method' => 'POST',
				'content' => json_encode($data),
				'header' => "Content-Type: application/json\r\n" .
					"Accept: application/json\r\n"
			)
		);

		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$responseData = json_decode($result, true);

		Log::create([
			'data_hora' => Carbon::now(),
			'car_id' => $responseData['_id'],
		]);

		return response()->json(json_decode($result));
	}

	public function logs(){
		return response()->json(Log::all());
	}

}