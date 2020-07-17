@extends('index')
@section('title', 'Editar Usuário')
@section('activeUser', 'activeElement')
@section('content')
    <h1 class="display-4 text-center">Editar Usuário</h1>
    <form class="needs-validation" action="{{ route('collaborator.update', $collaborator->id) }}" method="post" novalidate>
        @method('PUT')
        @include('collaborator.form')
    </form>
@endsection