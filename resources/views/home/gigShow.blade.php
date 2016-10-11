@extends('home.master')

@section('title' , $gig->title)

@section('scripts')

<script>

$(document).ready(function(){

  $('.carousel.carousel-slider').carousel({full_width: true});

});

</script>

@endsection

@section('content')

<div class="row">
     <div class="col s12 m12">
       <div class="card z-depth-0">
            <div class="card-content black-text">
              @if($gig->attachments)
                <div class="carousel carousel-slider">
                  @foreach($gig->attachments as $img)
                   <a class="carousel-item" href="#one!"><img src="/{{ $img }}"></a>
                  @endforeach
                </div>
              @endif
              <div class="row">
                <div class="col s12">
                  <h5 class="bold red-text">{{ $gig->title }}</h5>
                  <i class="material-icons left red-text">location_on</i>
                  <a target="_blank" href="https://www.google.com/maps?q={{ $gig->location }}">
                   <h6 style="line-height:1.6;">{{ $gig->location }}</h6>
                  </a>
                </div>
              </div>

              <div class="row">
                <div class="col s9">
                  <p class="thin">
                    {{ $gig->summary }}
                  </p>
                </div>
                <div class="col s3">
                  <div class="card-panel grey z-depth-0 white-text center-align" style="padding:5px;">
                    <h4>{{ ($gig->date > 1) ? $gig->date + ' days' : $gig->date + ' day'  }} </h4>
                    <h6>
                      Remaining
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
     </div>
</div>

@endsection
