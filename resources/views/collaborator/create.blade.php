@extends('index')
@section('title', 'Usuário')
@section('activeUser', 'activeElement')
@section('content')
    <h1 class="display-4">Novo Usuário</h1>
    <form action="{{ route('collaborator.store') }}" method="post" novalidate>
        @include('collaborator.form')
    </form>
@endsection