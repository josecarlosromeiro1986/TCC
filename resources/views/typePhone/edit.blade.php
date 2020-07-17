@extends('index')
@section('title', 'Editar Tipo de Telefone')
@section('activeTypePhone', 'activeElement')
@section('content')
    <div class="center-content">
        <h1 class="display-4 text-center">Editar Tipo de Telefone</h1>
        <form class="needs-validation" action="{{ route('typePhone.update', $typePhone->id) }}" method="post" novalidate>
            @method('PUT')
            @include('phone.typePhone.form')
        </form>
    </div>
@endsection