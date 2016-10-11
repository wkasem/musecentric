<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('imgs/favicon.ico') }} " type="image/x-icon">
    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.css') }}"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


    <style>
     body{
       background: white;
     }
     .container{
       height: 500px;
       background: rgb(236, 236, 236);
     }
     #messages{
       background: rgb(236, 236, 236);
       position: relative;
     }
     .container::before{
      content: '';
      height: 300px;
      background: #c34d4d;
      width: 100%;
      position: absolute;
      left: 0;
      z-index: -1;
     }
     .loading-messages{
       width: 100%;
       height: 100%;
       background: rgba(0, 0, 0, 0.87);
       position: absolute;
       z-index: 999;
       left: 0;
     }
     .loading-messages .preloader-wrapper{
       position: absolute;
        left: 50%;
        top: 50%;
     }
     #chartdiv {
  width: 100%;
  height: 500px;
}

.collection
{
  overflow: auto;
  border:none;
}
.collection .collection-item
{
  height: 130px;
  overflow: hidden;
}

.collection a.collection-item
{
  color: black;
}

.collection .collection-item.active
{
  background-color: #e53935;
}

.conversation-board
{
  height: 500px;
  overflow: auto;
}

    </style>

  </head>
  <body>

    <div class="container">
      @include('admin.Template')
       <admin
       users='{{ json_encode($users) }}'
       conversations='{{ json_encode($conversations) }}'
       musicans_percent='{{ $musicans_percent}}'
       recuters_percent='{{ $recuters_percent}}' count={{ $count }}></admin>
    </div>



  <!-- Compiled and minified JavaScript -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="{{ asset('js/all.js') }}"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
  <!-- Resources -->
  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/pie.js"></script>
  <script src="https://www.amcharts.com/lib/3/themes/chalk.js"></script>
  <script>
   $(document).ready(function(){

     new Vue({
       el : '.container'
     });

     $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
     });
   });
  </script>
  </body>
</html>
