<?php

namespace App\RegExp;

use Illuminate\Database\Eloquent\Model;

class RegExp extends Model
{
    public static function getHtml($webpage){


      $replace = str_replace("<", " ", $webpage);
      $html = str_replace(">", " ", $replace);

        return $html ;

    }


    public static function filterArray($filter,$array){


        $count = count($array) ;

      for ($i=0; $i < $count  ; $i++) {

        $check = is_array($array[$i]);


            if($check){

                  return self::filterArray($filter,$array[$i]) ;

            }


            else{


              $check = preg_match($filter,$array[$i]) ;

                if(!$check){

                  $returnArray[$i] = $array[$i] ;

                }

            }

      }

        if(isset($returnArray)){
          $returnValues = array_values($returnArray) ;

            return $returnValues;

        }

        else{

          return false ;
        }



    }



    public static function getCelNames($html,$string){

      $names = preg_match_all($string, $html, $namesArray) ;
      $urls = preg_match_all('~www.whosdated\w[^"]*~', $html, $urlsArray) ;
      $z = 0 ;


/*
      if($names === FALSE){

      $names =  preg_match_all('~ff-blog-title"\s+\w+[^/]*~', $html, $namesArray) ;

      }
*/

      $filteredUrlValues  =   self::filterArray('~-and-~', $urlsArray) ;
      $filteredNameValues = self::filterArray('~\sand\s~', $namesArray) ;

       $countUrls = count($filteredNameValues) ;



       $filtered =  [] ;


        for($i= 0 ; $i < count($filteredNameValues); $i++){


              if(($filteredNameValues[$i] !== 'alt="WDW')){

              $filtered[$z]['name'] =    str_replace('alt="', '',$filteredNameValues[$i]) ;
              $filtered[$z]['url']  =     $filteredUrlValues[$i] ;

              $z++ ;
          }

              else{


                unset($filteredNameValues[$i]);

              $temp =  array_values($filteredNameValues);

              $filteredNameValues = $temp;

                $i-- ;
              }

        }

          if($filtered !== []){


            return $filtered ;


          }

          else{

          return false ;

        }
    }

        public static function getDHistory($html){

            $markerHtml =   str_replace('/ul','+',$html) ;


            $history = preg_match('~dating-history"\s+h2[^+]*~', $markerHtml, $match) ;



            if($history){

                  $names = self::getCelNames($match[0],'~ff-blog-title"\s+[s\S][^/]*~') ;

                  $formatNames = self::replaceArray('~ff-blog-title"\s+~','',$names) ;


                  return $formatNames ;

            }

            else{

              return false ;
            }


        }




        public static function replaceArray($match,$replace,$array){

            $count = count($array) ;


                  for ($i=0; $i < $count; $i++) {

                        $formatArray[$i]['name'] = trim(preg_replace($match, $replace, $array[$i]['name'])) ;
                        $formatArray[$i]['url'] = $array[$i]['url'] ;
                        #$match[$i]['url'] = $array[$i]['url'] ;

                  }


                return $formatArray ;

          }

/**
 * [sortAlpArray sort DB->results Alphabetically for quicker matching]
 * @param  [array] $array [array]
 * @return [array]        [sorted array]
 */
       public static function sortAlpArray($array){



            $count = count($array) ;
            $z = 0;
            $beta = 'A' ;
            $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','w','u','v','x','y','z'] ;
            $reCheck = 0 ;
            $q = 0;

            $checkCounter = [] ;

            for ($i=0; $i < 27; $i++) {
              $checkCounter[$i] = 0;
            }

                for($i = 0; $i < $count; $i++){

                    $alpha = strtoupper(substr($array[$i]->name,0,1)) ;
                    $check = array_search(strtolower($alpha), $alphabet) ;


                      if($check !== FALSE){

                            $arranged[$check][$checkCounter[$check]]['name'] = $array[$i]->name ;
                            $arranged[$check][$checkCounter[$check]]['id'] = $array[$i]->id ;
                            $arranged[$check][$checkCounter[$check]]['url'] = $array[$i]->url ;

                            $checkCounter[$check]++;

                      }

                      else if(($array[$i]->id) && ($array[$i]->url)){


                            $arranged[26][$checkCounter[26]]['name'] = $array[$i]->name ;
                            $arranged[26][$checkCounter[26]]['id'] = $array[$i]->id ;
                            $arranged[26][$checkCounter[26]]['url'] = $array[$i]->url ;

                            $checkCounter[26]++;

                      }

                      else{



                      }


                      $reCheck = $check ;

                }


            return $arranged ;

       }

/**
 * [checkAlphLoc function for getting index of an alphabet letter to match
 * an array that's sorted alphabetically]
 * @param  [string] $checkUrl [letter to get index]
 * @return [int]           [index of alphabet array]
 */
          public static function checkAlphLoc($checkUrl){


            $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','w','u','v','x','y','z'] ;

            $check = strtolower($checkUrl) ;

            $location = array_search($check, $alphabet) ;

            if($location === FALSE){

              $location =  26;

            }

            return $location ;

          }

       public static function matchMasterList($needle, $array, $filter){

         $i = 0 ;

            foreach($array as $key){

                $sortArray[$i] = $key[$filter] ;

              $i++ ;
            }


            $check = array_search($needle, $sortArray) ;



            return $check ;

        }

}
