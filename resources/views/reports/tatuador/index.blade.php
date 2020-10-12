@extends('index')
@section('title', 'Relatórios')
@section('activeRep', 'activeElement')
@section('content')
    <div class="center-content">
        <br />
        <h3 class="text-center">Relatórios de Atendimentos por Tatuador</h3>
        <hr>
        @include('includes.alerts')
        <form action="{{ route('reports.tatuadorPdf') }}" method="get">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputState">Tatuador</label>
                    <select id="year" name='year' class="form-control" required>
                        <option value='ALL' selected>Todos os Anos</option>
                        @foreach ($years as $year)
                            <option value='{{ $year->year }}'>{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputState">Tatuador</label>
                    <select id="collaborator" name='collaborator' class="form-control" required>
                        <option value='ALL' selected>Todos Colaboradores</option>
                        @foreach ($collaborators as $collaborator)
                            <option value='{{ $collaborator->id }}'>{{ $collaborator->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" value="YEAR" checked>
                        <label class="form-check-label">Anual</label>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" value="MONTH">
                        <label class="form-check-label">Mensal</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-cst btn-block">Gerar PDF</button>
            <a href="{{ route('/') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
          </form>
    </div>
@endsection
