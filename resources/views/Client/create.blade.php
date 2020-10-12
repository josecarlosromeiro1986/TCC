@extends('index')
@section('title', 'Novo Cliente')
@section('activeCli', 'activeElement')
@section('content')
    <br />
    <h1>Novo Cliente</h1>
    <hr>
    <form class="needs-validation" action="{{ route('client.store') }}" method="post" novalidate>
        @include('client.form')
    </form>
@endsection
