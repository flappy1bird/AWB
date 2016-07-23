<?php


namespace App;
use DB ;
use App\Curl ;
use App\RegExp\RegExp ;




/**
 *
 */
class Videos
{


  public static function getVideos(){

     #$firstPages = DB::table('firstPages')->select('*')->get() ;

     #$count = count($firstPages) ;

      for($i = 0; $i < 1 ; $i++){

       #$url =  trim($firstPages[$i]->url)  ;
        $curl = Curl::Curl('http://xhamster.com/movies/1283107/japanese_school_girl_ami_matsuda_blowjob_and_facial.html');

        #$curl = Curl::Curl('http://xhamster.com/movies/1283107/japanese_school_girl_ami_matsuda_blowjob_and_facial.html');

        $html = RegExp::getHtml($curl) ;

        echo $curl;

          //Get Iframe //
          $checkEmbed = preg_match_all('~embed~', $html, $embed[$i])  ;

          print_r($embed)  ;

          if($checkEmbed){
            echo 'yes';
          }
          else{

            echo 'no' ;
          }


          /*

          echo '0';
          print_r($embed)  ;

          $iframe =  str_replace('=""','',$embed[$i][1]) ;


echo '1';

          $iframeSynTax = '<' . trim($iframe) . '></iframe>' ;

          //Iframe//

        $checkDesc =  preg_match('~caption"(.*?)/h2~', $html, $desc[$i])  ;

        echo '2';


          $insert['embed'] = $iframeSynTax ;
        #  $insert['title'] = $firstPages[$i]->desc ;
        echo '3';


          if($checkDesc){
          $insert['descript'] = $desc[$i][1] ;

        }
        #  $insert['id'] = $firstPages[$i]->id ;

        #  DB::table('videos')->insert($insert) ;

          //
          //description//

*/
        }


      }



}


















 ?>
