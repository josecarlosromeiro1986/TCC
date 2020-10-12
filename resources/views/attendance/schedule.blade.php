@extends('index')
@section('title', 'Novo Cliente')
@section('activeCreateAtt', 'activeElement')
@section('content')
@include('includes.alerts')
    <br />
    <h1 class="text-center">Agenda do {{ $data['collaborator_name'] }}</h1>
    <hr>
    <div id="app" data-route-schedule-index="{{ route('schedule.search', $data) }}">
        <calendar-component></calendar-component>
    </div>
    @include('includes.modal')
@endsection
