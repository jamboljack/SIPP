<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apisipp extends CI_Controller { 
    function __construct(){ 
        parent::__construct();
        $this->load->library('curl');
    } 
        
    public function index() { 
        $Npwrd  = '0103201600001';
        $url    = "http://apisipp.hotelhomkudus.com/apisipp/pedagang/id/".$Npwrd."/X-API-KEY"."/".'7712fcffc21bb7215f58035ab4506a5873c4af3c';
        $curl   = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        //execute the session
        $curl_response = curl_exec($curl);
        //finish off the session
        curl_close($curl);
        $curl_jason = json_decode($curl_response, true);
        print_r($curl_jason);
    } 
} 
/* Location: ./application/controllers/Apisipp.php */