@extends('index')
@section('title', 'Novo Tipo de Telefone')
@section('activeTypePhone', 'activeElement')
@section('content')
    <div class="center-content">
        <h1 class="display-4 text-center">Novo Tipo de Telefone</h1>
        <form class="needs-validation" action="{{ route('typePhone.store', $typePhone->id) }}" method="post" novalidate>
            @include('phone.typePhone.form')
        </form>
    </div>
@endsection