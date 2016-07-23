<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test</title>
</head>
<body>

    <div id="wrapper">


          <div class="container--large">

            @foreach($videos as $video)

            <div class="box--medium">

              <a href="videos\{{$video->id}}\{{$video->title}}">{{$video->embed}}</a>


            </div>


            @endforeach


          </div>


    </div>

</body>
</html>
