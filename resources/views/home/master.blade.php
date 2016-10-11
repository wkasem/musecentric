<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('imgs/favicon.ico') }} " type="image/x-icon">
    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.css') }}"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
      body{
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.08) 0%,rgba(255, 255, 255, 0.35) 100%);
        background-repeat: no-repeat;
          }

      .left-side{
        border-right: 1px solid rgba(0, 0, 0, 0.05);
        text-align: center;
      }

      ul.right-nav{padding-top: 50%;border-top: 1px solid rgba(0, 0, 0, 0.05);}
      ul.right-nav li a
      {
        color: rgb(173, 173, 173);
        padding: 5px;
        display: block;
        transition: color .2s ease-in-out;
        font-size: 21px;
        font-weight: 100;
        margin: 20px;
        cursor: pointer;
      }
      ul.right-nav li a.logout{font-weight: 700;}
      ul.right-nav li a:hover,
      p.user_actions a:hover
      {
        color: rgb(239, 52, 52);
      }

      p.user_actions a{color: rgb(173, 173, 173);padding: 0 6px;}
      p.user_actions a i{font-size: 30px;}
      #gig-teach .gigR a,
      #gig-teach .teachR a{
        height: 300px;
        display: block;
        text-align: center;
        font-size: 50px;
        line-height: 6;
        color: aliceblue;
        transition: all .5s ease-in-out;
        background-size:cover;
        background-repeat: no-repeat;
      }
      #gig-teach .gigR:hover a,
      #gig-teach .teachR:hover a{
        color: rgba(255, 0, 0, 0.61);
      }
      #gig-teach .gigR a{
        background-image: url('/imgs/gig-foto.jpg');

      }
      #gig-teach .teachR a{
        background-image: url('/imgs/teach-foto.jpg');
      }

      .main-progress{
        position: fixed;
        margin: 0;
        z-index: 9999;
        top: 0;
        display: none;
      }
    </style>

    @if(auth()->user()->unreadNotifications->count())
      <style>
      .notification{position: relative;}
      .notification::before{
        content:'{{auth()->user()->unreadNotifications->count()}}';
        background: red;
        position: absolute;
        right: 0;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        line-height: 2;
        color: white;
        font-size: 11px;
        bottom: 20px;
        font-weight: 700;
      }
      </style>
     @endif
    @yield('styles')
  </head>
  <body>
    <div class="progress main-progress white">
         <div class="indeterminate red"></div>
     </div>
  <div class="container" style="min-height:660px; width:94%">
    <div class="row">
      <div class="col l2 m2 s2 left-side">
        <img src="{{ asset('imgs/logo-sm.png') }}" class="responsive-img" />
        <p>
          <a href="{{ route('userProfile' , ['id' => auth()->user()->id])}}" class="black-text">
            <h5 style="font-weight:900;">{{ auth()->user()->first_name}}</h5>
          </a>

          <h6>{{ auth()->user()->type()->first()->name}}</h6>
        </p>
        <p class="user_actions">
          @if(auth()->user()->type == 1)
           <a href="#upload" class="modal-trigger"><i class="material-icons">cloud_upload</i></a>
          @endif
          <a href="#gig-teach" class="modal-trigger"><i class="material-icons">mode_edit</i></a>
          <a href="/messages"><i class="material-icons">mail_outline</i></a>
          <a href="/notifications" class="notification">
            <i class="material-icons">notifications</i>
          </a>
        </p>
        <ul class="right-nav">
          <li> <a href="/gigs">Gigs</a> </li>
          @if(auth()->user()->type == 1)
           <li> <a href="/my-classes">My Classes</a> </li>
          @endif
          @if(auth()->user()->type == 2)
           <li> <a href="/my-gigs">My Gigs</a> </li>
          @endif
          <li> <a href="/settings">Settings</a> </li>
          <li> <a href="/logout" class="logout">Logout</a> </li>
        </ul>
      </div>
      <div class="col l10 m10 s10" id="app">
        @yield('content')
      </div>
    </div>
  </div>


  @include('home.partials.upload')

  @include('home.partials.gig-teach')

  @include('home.partials.footer')

  <!-- Compiled and minified JavaScript -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="{{ asset('js/all.js')}}"></script>
  <script>
  $(document).ready(function(){

    new Vue({
      el : '#app'
    });

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.modal-trigger').leanModal();


     window.showProgressLine = function(){
        $('.main-progress').show();
     }
     window.hideProgressLine = function(){
        $('.main-progress').hide();
     }

     window.startProgress = function (){
       window.modalExit = $._data($('.lean-overlay')[0] , 'events').click[0].handler;
       showProgressLine();
       $('.modal .modal-shadow').show();
       $('.lean-overlay').unbind('click');
     };

     window.endProgress = function (){
       hideProgressLine();
       $('.modal .modal-shadow').hide();
       $('.lean-overlay').bind('click' , window.modalExit);
     };

     Dropzone.options.media = {
      paramName: "media",
      maxFilesize: 20,
      addRemoveLinks : true,
      acceptedFiles : 'audio/mp3,audio/ogg,audio/wav',
      dictDefaultMessage : 'Drop Your Media Here',
      dictRemoveFile : 'Remove Media'
     };

   });
  </script>
   @yield('scripts')
  </body>
</html>
