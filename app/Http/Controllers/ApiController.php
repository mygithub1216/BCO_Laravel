<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

	public function __construct() {

	}

	public function marketnews() {

		$client = new \GuzzleHttp\Client();
		$response = $client->get("http://americanshipper.com/feed.aspx?sn=ASDaily");


		if($response->getStatusCode() == 200) {
			$xml = strval($response->getBody()->getContents());
						
			return $xml;

		} else {
			return true;
		}


	}

	public function latest_news() {

		$news = \App\NewsItem::latest()->with(['created_by' => function($query) {
			$query->select('id', 'name');
		}
		])->limit(5)->get();
		
		return $news;
	}

	public function new_members() {
		$members = \App\User::latest()->select(['name', 'organization'])->limit(5)->get();

		return $members;
	}
}