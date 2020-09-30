@extends('index')
@section('title', 'Novo Cliente')
@section('activeAtt', 'activeElement')
@section('content')
    <h1 class="display-4 text-center">Agenda do {{ $data['collaborator_name'] }}</h1>

    <div id="app" data-route-schedule-index="{{ route('schedule.search', $data) }}">
        <calendar-component></calendar-component>
    </div>
    @include('includes.modal')
@endsection
