<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style>
    body{
      background-image: linear-gradient(to right, rgba(0, 0, 0, 0.78) 0%,
                  rgba(255, 255, 255, 0.3) 100%) ,
                  url('imgs/Bourbon-Street-Musicians.jpg') !important;
      background-size: cover;
    }

    @media only screen and (min-width: 993px) {

      .container{
        margin: 100px auto;
        width: 40%;
      }
    }

  </style>
  </head>
  <body>

   <div class="container">
    <div class="card">
      <div class="card-content">
        <div class="row">
         <form class="col s12" action="/admin/login" method="post">
           {{ csrf_field() }}
           <div class="row">
             <div class="input-field col s12">
               <input id="email" type="email" class="validate" name="email">
               <label for="email">Email</label>
             </div>
           </div>
           <div class="row">
             <div class="input-field col s12">
               <input id="password" type="password" class="validate" name="password">
               <label for="password">Password</label>
             </div>
           </div>
           <div class="row">
             <div class="input-field col s12">
               <button type="submit" class="btn red">Login</button>
             </div>
           </div>
         </form>
       </div>
      </div>
    </div>
  </div>
  <!-- Compiled and minified JavaScript -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  </body>
</html>
