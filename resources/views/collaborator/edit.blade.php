@extends('index')
@section('title', 'Editar Usuário')
@section('activeUser', 'activeElement')
@section('content')
    <br />
    <h1>Editar Usuário</h1>
    <hr>
    <form class="needs-validation" action="{{ route('collaborator.update', $collaborator->id) }}" method="post" novalidate>
        @method('PUT')
        @include('collaborator.form')
    </form>
@endsection
