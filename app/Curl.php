<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RandomUserAgent ;

class Curl extends Model
{

    public static function Curl($url){

      ini_set('max_execution_time', 0);

  $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE,   //Setting cURL's option to return the webpage data;
            CURLOPT_FOLLOWLOCATION => FALSE, // Setting cURL to follow 'location HTTP headers;
            CURLOPT_CONNECTTIMEOUT => 5000, //Setting the amount  of time(in secs) before request times out;
            CURLOPT_TIMEOUT => 5000, // Setting the maximum amount of time for curl to execute queries;
            CURLOPT_MAXREDIRS => 5000, // Setting the maximum number of redirections to follow;
            CURLOPT_USERAGENT => RandomUserAgent::random_user_agent(), //SETTING THE USERAGENT;

            CURLOPT_REFERER => "",

            CURLOPT_URL => $url, //SETTING CURLS URL OPTION
          );

      $ch = curl_init(); //Initalising curl;
      curl_setopt_array($ch, $options); // Setting cURL's options  using the  previously  assigned  array data in $options;
      $data = curl_exec($ch); // Executing cURL;
      curl_close($ch);


      return $data;

    }
}
