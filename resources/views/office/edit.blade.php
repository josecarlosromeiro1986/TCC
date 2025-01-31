@extends('index')
@section('title', 'Editar Cargo')
@section('activeOffice', 'activeElement')
@section('content')
    <div class="center-content">
        <br />
        <h1 class="text-center">Editar Cargo</h1>
        <form class="needs-validation" action="{{ route('office.update', $office->id) }}" method="post" novalidate>
            @method('PUT')
            @include('office.form')
        </form>
    </div>
@endsection
