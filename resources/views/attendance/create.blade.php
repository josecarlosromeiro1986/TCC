@extends('index')
@section('title', 'Novo Cliente')
@section('activeAtt', 'activeElement')
@section('content')
    <h1 class="display-4">Novo Atendimento</h1>
    <form class="needs-validation" action="{{ route('attendance.store') }}" method="post" novalidate>
        
    </form>
@endsection