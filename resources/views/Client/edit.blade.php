@extends('index')
@section('title', 'Editar Cliente')
@section('activeCli', 'activeElement')
@section('content')
    <h1 class="display-4 text-center">Editar Cliente</h1>
    <form class="needs-validation" action="{{ route('client.update', $client->id) }}" method="post" novalidate>
        @method('PUT')
        @include('client.form')
    </form>
@endsection