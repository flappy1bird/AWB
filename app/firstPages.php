<?php

namespace App;

use App\Curl ;
use App\RegExp\RegExp ;
use Symfony\Component\DomCrawler\Crawler;
use DB ;

class firstPages
{
    public static function getFirstPages(){

      $j = 1;
      $trig = false ;
      $site = (string)getenv('APP_SITE') ;

      while($j < 500){

        $curl = Curl::Curl($site. $j .'.html') ;
        sleep(3);

         $j++;

      #   echo ' ' . $j . ' ' ;

        $html = RegExp::getHtml($curl);

        preg_match_all('~class="video(.*?)views-value~', $html, $matches);

        $count = count($matches[1]) ;



        $http = [] ;

        if($count > 1){

      #    echo ' is count ' ;

          for($i = 0; $i < $count; $i++){

              $checkHttp = preg_match('~http[^"]*~', $matches[1][$i],$http[$i]) ;
          $checkDesc =   preg_match('~alt="(.*?)"~', $matches[1][$i],$desc[$i]) ;
          $checkSrc =   preg_match("~src='(.*?)jpg~", $matches[1][$i],$src[$i]) ;
          $checkEmbed =   preg_match("~\d+~", $http[$i][0],$embed[$i]) ;
          $checkRuntime =   preg_match("~b(\s\d+:\d+)~", $matches[1][$i],$runtime[$i]) ;


        }

          $srcCount = count($src);

          $var = array_values($src);


        if($checkSrc !== FALSE){

            for($i = 0; $i < $srcCount; $i++){

              echo ' ' . $i . ' ' ;
              if(isset($src[$i][0])){
               $srcReplace =  str_replace(["src='"],'', $src[$i][0]) ;
               $srcReplace2 =  str_replace(["src='",'.jpg','http://'],'', $src[$i][0]) ;

              # copy($srcReplace, "public/Images/". $i .'.jpg');

               if(isset($http[$i])){

                    $firstPage[$i]['url'] = $http[$i][0];
                    $firstPage[$i]['img'] = $srcReplace;
                    $firstPage[$i]['desc'] = $desc[$i][1];
                    $firstPage[$i]['embed'] = $embed[$i][0];
                    $firstPage[$i]['runtime'] = trim($runtime[$i][1]);


                $trig = true ;
              }


                }


            }
            }

        #    else{
        #      echo ' not set ' ;
        #    }



          if($trig){

            DB::table('firstPages')->insert($firstPage) ;

            $trig = false ;

              }

          else{

              echo 'no result' ;
          }

}
}}
}
