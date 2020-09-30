@extends('index')
@section('title', 'Novo Cliente')
@section('activeAtt', 'activeElement')
@section('content')
    <div class="center-content">
        <h1 class="display-4 text-center">Novo Atendimento</h1>
        <form class="needs-validation" action="{{ route('schedule.collaborator') }}" method="get" novalidate>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="client_id">Cliente</label>
                    <select name="client_id" id="client_id" class="form-control shadow-sm" placeholder="Selecione o Cliente:" required>
                        <option selected disabled value="">Selecione o Cliente:</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        O Cliente é Obrigatório!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="collaborator_id">Tatuador</label>
                    <select name="collaborator_id" id="collaborator_id" class="form-control shadow-sm" placeholder="Selecione o Tatuador:" required>
                        <option selected disabled value="">Selecione o Tatuador:</option>
                        @foreach ($collaborators as $collaborator)
                            <option value="{{ $collaborator->id }}">{{ $collaborator->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        O Tatuador é Obrigatório!
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-cst btn-primary btn-block">Buscar Agenda</button>
        </form>
    </div>
@endsection
