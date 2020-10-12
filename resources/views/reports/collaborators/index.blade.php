@extends('index')
@section('title', 'Relatórios')
@section('activeRep', 'activeElement')
@section('content')
    <div class="center-content">
        <br />
        <h3 class="text-center">Relatórios de Colaboradores Cadastrados</h3>
        <hr>
        <form action="{{ route('reports.collaboratorPdf') }}" method="get">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputState">Tipo de Relatório</label>
                    <select id="type" name='type' class="form-control" required>
                        <option value='ALL' selected>Todos Colaboradores</option>
                        <option value='ACTIVE'>Colaboradores ativos</option>
                        <option value='INACTIVE'>Colaboradores inativos</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-cst btn-block">Gerar PDF</button>
            <a href="{{ route('/') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
          </form>
    </div>
@endsection
