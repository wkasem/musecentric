@extends('home.master')

@if(auth()->user()->type == 2)
 @section('title' , 'My Gigs')
@else
 @section('title' , 'My Classes')
@endif


@section('scripts')
 <script src="{{ asset('js/mygigs.js') }}"></script>
 <script src="{{ asset('js/myteaches.js') }}"></script>
 <script src="{{ asset('js/mycontracts.js') }}"></script>
@endsection

@section('styles')

<style>
.new-gig
{
  transition: background 5s ease-out;
}
.new-gig.new-gig-appear
{
  background: rgba(255, 0, 0, 0.67);
}
</style>

@endsection

@section('scripts')

<script>
$(document).ready(function(){
  setTimeout(function(){
    $('.new-gig').removeClass('new-gig-appear');
  },'2000');
});
</script>
@endsection

@section('content')

<div class="row">
  <div class="col s12">
    <ul class="tabs">
      @if(auth()->user()->type == 2)
      <li class="tab col s3"><a class="active" href="#gigs">Gigs</a></li>
      <li class="tab col s3"><a href="#teaching">Teaching</a></li>
      @endif
      @if(auth()->user()->type == 1)
       <li class="tab col s3"><a href="#teaching">Teaching</a></li>
       <li class="tab col s3"><a href="#contracts">Contracts</a></li>
      @endif
    </ul>
  </div>
  @if(auth()->user()->type == 2)
  <div id="teaching" class="col s12">
    @include('home.partials.myteachRaw')
    <myteaches teaches='{{ json_encode($teaches) }}'></myteaches>
  </div>
    <div id="gigs" class="col s12">
      @include('home.partials.mygigRaw')
      <mygigs gigs='{{ json_encode($gigs) }}'></mygigs>
    </div>
  @endif
  @if(auth()->user()->type == 1)
  <div id="teaching" class="col s12">
    @include('home.partials.myteachRaw')
    <myteaches teaches='{{ json_encode($teaches) }}'></myteaches>
  </div>
  <div id="contracts" class="col s12">
    @include('home.partials.mycontractsTemp')
    <mycontracts contracts='{{ json_encode($contracts) }}'></mycontracts>
  </div>
  @endif
</div>


@endsection
