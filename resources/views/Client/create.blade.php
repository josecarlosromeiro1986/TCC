@extends('index')
@section('title', 'Novo Cliente')
@section('activeCli', 'activeElement')
@section('content')
    <h1 class="display-4">Novo Cliente</h1>
    <form class="needs-validation" action="{{ route('client.store') }}" method="post" novalidate>
        @include('client.form')
    </form>
@endsection