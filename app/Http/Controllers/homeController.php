<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curl ;
use App\RegExp\RegExp ;
use Symfony\Component\DomCrawler\Crawler;
use App\FirstPages ;
use App\Videos ;
use DB ;


use App\Http\Requests;

class homeController extends Controller
{
    public function test()
    {
       FirstPages::getFirstPages() ;
    #  Videos::getVideos();

    }

    public function page()
    {

      $thumbs = DB::table('firstPages')->select('*')->take(40)->get() ;

      return view('index',compact('thumbs')) ;

    }

    public function mainVid(Request $request)
    {
      $id = $request->id ;
      $desc = $request->desc ;

      $videos = DB::table('catalog')->select('*')->where('id_marker','=',$id)->get() ;



      return view('videos', compact('videos')) ;
    }

}
