@extends('index')
@section('title', 'Usuário')
@section('activeUser', 'activeElement')
@section('content')
    <br/>
    <h1>Novo Usuário</h1>
    <hr>
    <form class="needs-validation" action="{{ route('collaborator.store') }}" method="post" novalidate>
        @include('collaborator.form')
    </form>
@endsection
