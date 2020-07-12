@extends('index')
@section('title', 'Novo Cargo')
@section('activeOffice', 'activeElement')
@section('content')
<div class="center-content">
    <h1 class="display-4 text-center">Novo Cargo</h1>
    <form class="needs-validation" action="{{ route('office.store') }}" method="post" novalidate>
        @include('office.form')
    </form>
</div>
@endsection