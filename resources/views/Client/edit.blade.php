@extends('index')
@section('title', 'Editar Cliente')
@section('activeCli', 'activeElement')
@section('content')
    <br />
    <h1>Editar Cliente</h1>
    <hr>
    <form class="needs-validation" action="{{ route('client.update', $client->id) }}" method="post" novalidate>
        @method('PUT')
        @include('client.form')
    </form>
@endsection
