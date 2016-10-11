@extends('home.master')

@section('title' , 'Settings')


@section('content')

@if(auth()->user()->type == 2)
  <div class="row card z-depth-0">
    <div class="card-content">
      <h5 class="thin">Billing</h5>
      @if(auth()->user()->subscribed)
        <h6>You Have Subscribed To Monthly Fee </h6>
      @else
       <h6 class="thin">You Have to subscribe monthly to be able to post new gigs</h6>
       <a href="/subscribe" class="btn-flat green white-text">Subscribe</a>
      @endif
    </div>
  </div>
@endif

<div class="row card z-depth-0">
  <div class="card-content">
    <h5 class="thin">Change Password</h5>
    <div class="col s12">
      <form method="post" action="password/reset">
        <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
        {{ csrf_field() }}
        <div class="row">
          <div class="input-field col s6">
            <input type="password" id="new_pass" name="password" />
            <label for="new_pass">New Password</label>
          </div>
          <div class="input-field col s6">
            <input type="password" id="new_pass_confirm" name="pasowrd_confirmation" />
            <label for="new_pass_confirm">Confirm New Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn red">Change</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection
