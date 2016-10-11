@extends('home.master')

@section('title' , 'Gigs')

@section('scripts')
 <script src="{{ asset('js/gigs.js') }}"></script>
 <script src="{{ asset('js/teaching.js') }}"></script>
@endsection

@section('content')

<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s3"><a class="active" href="#gigs">Gigs</a></li>
      <li class="tab col s3"><a href="#teaching">Teaching</a></li>
    </ul>
  </div>
  <div id="gigs" class="col s12">
    @include('home.partials.gigRaw')

    <gigs gigs="{{ json_encode($gigs) }}" path="{{ storage_path() }}" user_id={{ auth()->user()->id }}></gigs>
  </div>
  <div id="teaching" class="col s12">
    @include('home.partials.teachingRaw')

   <teaching teaches="{{ json_encode($teaches) }}" path="{{ storage_path() }}" user_id={{ auth()->user()->id }}></teaching>
  </div>
</div>


@endsection
