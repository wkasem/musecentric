<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Musecentric</title>

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

        </style>
    </head>
    <body>

      <!-- Modal Structure -->
      <div id="terms-pop" class="modal modal-fixed-footer">
        <div class="modal-content">
          <h4>TERMS OF SERVICE</h4>
          @include('partials.terms')
        </div>
        <div class="modal-footer">
          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col l12 m12 s12">
            <p class="center-align">
              <img src="imgs/logo.png" />
            </p>
            <h1 class="white-text thin center-align">online network for musicians</h1>
          </div>
        </div>

        <div class="card" style="background:transparent;">
          <div class="card-content white-text">
            <span class="card-title activator white-text text-darken-4 right" style="line-height:27px;">
              <i class="material-icons right">more_vert</i>Login
            </span>
            <div class="row">
             <form class="col s12" action="/register" method="post">
               {{ csrf_field() }}
               <div class="row">
                 <div class="input-field col s6">
                   <input  id="first_name" type="text" class="validate" name="first_name">
                   <label for="first_name">First Name</label>
                 </div>
                 <div class="input-field col s6">
                   <input id="last_name" type="text" class="validate" name="last_name">
                   <label for="last_name">Last Name</label>
                 </div>
               </div>
               <div class="row">
                 <div class="input-field col s12">
                   <input id="password" type="password" class="validate" name="password">
                   <label for="password">Password</label>
                 </div>
               </div>
               <div class="row">
                 <div class="input-field col s6">
                   <input id="email" type="email" class="validate" name="email">
                   <label for="email">Email</label>
                 </div>
                 <div class="input-field col s6">
                    <select class="browser-default black-text" name="type">
                      <option value="1">Musican</option>
                      <option value="2">recruiter</option>
                    </select>
                  </div>
               </div>
               <div class="row">
                 <div class="input-field col s12 white-text">
                  By Signing Up You are accept <a class="modal-trigger" href="#terms-pop">terms and conditions</a>
                 </div>
               </div>
               <div class="row">
                 <div class="input-field col s12">
                   <button type="submit" class="btn red">Sign Up</button>
                 </div>
               </div>
             </form>
           </div>
          </div>
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Login<i class="material-icons right">close</i></span>
            <div class="row" style="margin:0;">
             <form class="col s12" action="/login" method="post">
               {{ csrf_field() }}
               <div class="row">
                 <div class="input-field col s12">
                   <input  id="email" type="text" class="validate" name="email">
                   <label for="email">Email</label>
                 </div>
               </div>
               <div class="row">
                 <div class="input-field col s12">
                   <input  id="password" type="password" class="validate" name="password">
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

      <div class="row" style="margin-bottom:0;">
        <div class="col s12 valign-wrapper" style="height:300px;background:white;">
          <div class="container">
              <h5 class="valign flow-text">
                Musecentric is an online network for musicians to find gigs, teaching opportunities and establish connections amongst each other.
                There is no fee to sign up so what are you waiting for?
              </h5>
          </div>
        </div>
      </div>

     @include('home.partials.footer')


      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
      <script>
      $(document).ready(function(){
         $('.modal-trigger').leanModal();
       });
      </script>
      @if (session('has-sent'))
        <script>
        $(document).ready(function(){

          Materialize.toast('Your Feedback has been sent', 4000);
        });
        </script>
      @endif
    </body>
</html>
