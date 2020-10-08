@extends('index')
@section('title', 'Relatórios')
@section('activeRep', 'activeElement')
@section('content')
    <div class="center-content">
        <h3 class=" text-center">Relatórios de Atendimentos</h3>
        <form class="needs-validation" action="{{ route('reports.attendancePdf') }}" method="get" novalidate>
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start">Data Inicial</label>
                    <input type="date" class="form-control shadow-sm" name="start" id="start" value="" required>
                    <div class="invalid-feedback">
                        A Data Inicial é Obrigatória!
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="end">Data Final</label>
                    <input type="date" class="form-control shadow-sm" name="end" id="end" value="" required>
                    <div class="invalid-feedback">
                        A Data Final é Obrigatória!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start">Tatuador</label>
                    <select id="collaborator" name='collaborator' class="form-control" required>
                        <option value='ALLCOL' selected>Todos Tatuadores</option>
                        @foreach ($collaborators as $collaborator)
                            <option value='{{ $collaborator->id }}'>{{ $collaborator->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="end">Cliente</label>
                    <select id="client" name='client' class="form-control" required>
                        <option value='ALLCLI' selected>Todos Clientes</option>
                        @foreach ($clients as $client)
                            <option value='{{ $client->id }}'>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputState">Tipo de Relatório</label>
                    <select id="type" name='type' class="form-control" required>
                        <option value='ALL' selected>Todos Atendimentos</option>
                        <option value='OPEN'>Atendimentos em aberto</option>
                        <option value='CLOSED'>Atendimentos fechados</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Gerar PDF</button>
            <a href="" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
          </form>
    </div>
@endsection
