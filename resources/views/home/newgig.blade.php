@extends('home.master')

@section('title' , 'New Gig')

@section('styles')
<style>
.z-depth-0{border:1px solid rgba(0, 0, 0, 0.15);}
</style>

@section('scripts')

<script src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>
<script src="{{ asset('js/jquery.geocomplete.js') }}"></script>

<script>
$(document).ready(function() {
    $("#requirements").dynamiclist({
      itemClass : 'collection-item'
    });

    $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15
  });

  $(".location").geocomplete();
});

</script>

@if (count($errors) > 0)
    <script>
    $(document).ready(function(){

      Materialize.toast('Your Have Missed Something', 4000);
    });
    </script>
@endif
@endsection
@section('content')

<div class="row" style="padding-left:5px;">
    <form action="/new-gig" method="post" class="col s12 card z-depth-0" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="input-field col s12">
          <h6 class="thin">Title</h6>
          <input  type="text" name="title">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <h6 class="thin">requirements</h6>
          <ul class="collection" id="requirements">
           <li class="collection-item">
             <input type="text" name="requirements[0].name" />
              <a href="#" class="list-remove"><i class="red-text material-icons">remove_circle</i></a>
           </li>
           <a href="#" class="list-add btn-flat"><i class="material-icons">add</i></a>
          </ul>
          </div>
        </div>
        <div class="row">
          <div class="file-field input-field">
          <div class="btn btn-flat green white-text">
            <span>Attach</span>
            <input type="file" multiple name="attachments[]" accept="image/jpeg">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
         </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <h6 class="thin">Date</h6>
            <input type="date" class="datepicker" name="date">
          </div>
          <div class="input-field col s6">
            <h6 class="thin">Budget</h6>
            <input type="number"  name="budget" min="1">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <h6 class="thin">Location</h6>
            <input type="text" name="location" class="location">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <h6 class="thin">Summary</h6>
            <textarea name="summary" class="materialize-textarea"></textarea>
          </div>
        </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn green">Post</button>
        </div>
      </div>
    </form>
  </div>

@endsection
