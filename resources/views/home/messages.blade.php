@extends('home.master')

@section('title' , 'Messages')

@section('scripts')

<script src="{{ asset('js/messages.js') }}"></script>

@endsection

@section('styles')

<style>

.collection
{
  overflow: auto;
  border:none;
}
.collection .collection-item
{
  height: 130px;
  overflow: hidden;
}

.collection a.collection-item
{
  color: black;
}

.collection .collection-item.active
{
  background-color: #e53935;
}

.conversation-board
{
  height: 500px;
  overflow: auto;
}

</style>

@endsection
@section('content')


 @include('home.partials.messages')

 <messages conversations="{{ json_encode($conversations) }}"
           user_id="{{ auth()->user()->id}}"
           crr_id="{{ $crr_id }}">
 </messages>

@endsection
