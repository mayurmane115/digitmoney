<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        helper(['curl']);
        $rest_api_base_url = 'http://localhost:8080/';

        //GET - list of users
		$get_endpoint = 'customers';
        $response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);

		$data=json_decode($response,true);
        
        
        return view('customers',$data);
    }

    public function search($keyword=null){
        helper(['curl']);
        $rest_api_base_url = 'http://localhost:8080/';

        //GET - list of users
		$get_endpoint = 'customers-search/'.$keyword;
        $response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);

		$data['customers']=json_decode($response,true);
        // print_r($data['customers']);
        echo view('customers_data',$data);
        
    }
}
