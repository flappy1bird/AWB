<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB ;

class Aggregate extends Model
{
    public static function aggregateResults(){

     $firstPages =  DB::table('firstPages')->select('*')->get();

     $count= count($firstPages);

     $testArray = [];
     $finalArray = [];



     for($i = 0; $i < $count; $i++){

       echo $i;
       $check = array_search($firstPages[$i]->embed,$testArray);

        if($check === FALSE){

            $testArray[$i] = $firstPages[$i]->embed;

            $finalArray[$i]['id_marker'] = $firstPages[$i]->id ;
            $finalArray[$i]['url'] = $firstPages[$i]->url ;
            $finalArray[$i]['embed'] = $firstPages[$i]->embed ;
            $finalArray[$i]['img'] = $firstPages[$i]->img ;
            $finalArray[$i]['title'] = $firstPages[$i]->desc ;
            $finalArray[$i]['runtime'] = $firstPages[$i]->runtime ;

            DB::table('catalog')->insert($finalArray[$i]) ;


        }


      }




    }
}
