@extends('home.master')

@section('title' , auth()->user()->first_name)

@section('styles')

<style>

.profile{
  background: #e91e63;
  min-height: 200px;
}
.profile .profile-letter{
  display: inline-block;
  width: 100px;
  height: 100px;
  background: #ef3535;
  font-size: 55px;
  text-align: center;
  border-radius: 50%;
  line-height: 1.8;
  box-shadow: 0 1px 3px;
  color: floralwhite;
}
.profile .profile-name{
  color: white;
}

.audio-control
{
  width: 100px;
  height: 100px;
  margin: 33px;
  border-radius: 71%;
  box-shadow: 1 0px;
  background: rgba(0, 0, 0, 0.05);
}

.audio-control.playing
{
  animation: playing 1s infinite linear;
}

@@keyframes playing {

  from{
    border:1px solid rgb(255, 0, 0);
  }

  to{
    border:5px solid rgba(255, 0, 0 , 0.20);
  }

}

.audio-control i
{
  font-size: 50px;
  vertical-align: middle;
  text-align: center;
  margin: -10px;
}

</style>

@endsection

@section('scripts')
 <script src="{{ asset('js/gigs.js') }}"></script>
 <script src="{{ asset('js/teaching.js') }}"></script>
 <script src="{{ asset('js/profile.js') }}"></script>

<script>

$(document).ready(function(){

  var states = {play : 'play_arrow' , pause : 'pause'};

  $('.play i').click(function(e){
    e.stopPropagation();
    $(e.target).parent()[0].click();
  });

  $('.play').click(function(e){
    var audio = $('.player')[0];
    var source = $('.player').find('source')[0];
    var i     = $(e.target).find('i')[0];
    var src  = $(this).data('src');
    var ext  = ($(this).data('ext') == 'mpga') ? 'mp3' : $(this).data('ext');
    if('http://music.dev' + src != source.src){
      $('.playing').each(function(i , p){
        $($(p).find('i')).text(states.play);
        $(p).removeClass('playing');
      });
      $(i).text(states.pause);
      $(e.target).addClass('playing');
      source.src = src;
      source.type = 'audio/' + ext;
      audio.load();
      audio.play();
    }else{
      if(audio.paused){
        $(i).text(states.pause);
        $(e.target).addClass('playing');
        audio.play();
      }else{
        $(i).text(states.play);
        $(e.target).removeClass('playing');
        audio.pause();
      }
    }


  });
});

</script>


@endsection


@section('content')

<div class="row bg z-depth-0">

@include('home.partials.profileTemp')


<profile user="{{ json_encode($user) }}"
         curr_user='{{ auth()->user() }}'
         >
</profile>

  <div class="col s12 divider"></div>

  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        @if($user->type == 1)
         <li class="tab col s3"><a class="active" href="#music">Music</a></li>
        @endif
        @if($user->type == 2)
         <li class="tab col s3"><a class="active" href="#gigs">Gigs</a></li>
        @endif
        <li class="tab col s3"><a href="#teaching">Teaching</a></li>
      </ul>
    </div>

       @if($user->type == 1)
        <div id="music" class="col s12">
          @if($user->media()->count())
            @foreach($user->media()->get()->chunk(3) as $chunks)
              <div class="row"  style="margin-left:1px;">
                <audio style="display:none;" class="player">
                  <source type="">
                </audio>
                @foreach($chunks as $media)
                  <div class="col s3 card z-depth-0" style="text-align:center;margin:20px;">
                  <button class="btn-flat audio-control play"
                     data-src="/media/{{ $media->user_id }}/{{ $media->media_src }}"
                     data-ext="{{ $media->extension() }}">
                    <i class="material-icons">play_arrow</i>
                  </button>
                  </div>
                @endforeach
              </div>
            @endforeach
            @else
            <div class="row">
              <div class="col s12">
                <div class="card z-depth-0">
                  <div class="card-content">
                    <h5 class="thin center-align">Nothing To Show</h5>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
       @endif

      @if($user->type == 2)
      <div id="gigs" class="col s12">
        @include('home.partials.gigRaw')
        <gigs gigs="{{ json_encode($user->gigs) }}" path="{{ storage_path() }}" profile="true"></gigs>
      </div>
      @endif

      <div id="teaching" class="col s12">
        @include('home.partials.teachingRaw')

       <teaching teaches="{{ json_encode($user->teaches) }}" path="{{ storage_path() }}" profile="true"></teaching>
      </div>

    </div>

</div>

@endsection
