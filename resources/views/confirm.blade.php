<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Confirmation | {{ auth()->user()->first_name }}</title>

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <style>
          body{
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.08) 0%,rgba(255, 255, 255, 0.35) 100%);
            background-repeat: no-repeat;
              }
        </style>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col s12">
          <h3 class="thin center-align">We have Sent you an Email To Confirm Your Account</h3>
        </div>
        <div class="col s12">
          <h5 class="thin center-align">
            Please Confirm Your email
          </h5>
          <p class="center-align">

            <a href="{{ url('confirmation/resend')}}" class="btn-flat green white-text ">Resend</a>
          </p>
        </div>
      </div>
    </div>

  </body>
</html>
