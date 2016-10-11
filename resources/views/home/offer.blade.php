@extends('home.master')

@section('title' , $offer->gig->title . "'s offer" )


@section('content')


<div class="card z-depth-0">
  <div class="card-content center-align">
    <a href="/gig/{{$offer->gig->id}}"><h4 class="thin red-text">{{ $offer->gig->title }}</h4></a>
    <h5 class="thin green-text">{{ $offer->bid->budget }}$</h5>
    <p>
      {{ $offer->bid->cover_letter }}
    </p>
    <div class="card-action">
      <a href="/offer/{{$offer->id}}/accept" class="btn-flat green white-text">Accept</a>
      <a href="/offer/{{$offer->id}}/decline" class="btn-flat red white-text">Decline</a>
    </div>
  </div>
</div>


@endsection
