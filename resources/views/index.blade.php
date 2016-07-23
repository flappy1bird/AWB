<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test</title>
</head>
<body>

    <div id="wrapper">


          <div class="container--large">

            @foreach($thumbs as $thumb)

            <div class="box--medium">

              <a href="videos\{{$thumb->id}}\{{$thumb->desc}}">{{$thumb->desc}}</a>


            </div>


            @endforeach


          </div>


    </div>

</body>
</html>
