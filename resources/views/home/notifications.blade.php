@extends('home.master')

@section('title' , 'Notifications')

@section('scripts')

<script src="{{ asset('js/notifications.js') }}"></script>

@endsection

@section('content')

@include('home.partials.notificationsTemp')

<notifications notis='{{ json_encode($notifications)}}'></notifications>

@endsection
