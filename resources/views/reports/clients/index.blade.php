@extends('index')
@section('title', 'Relatórios')
@section('activeRep', 'activeElement')
@section('content')
    <div class="center-content">
        <h3 class=" text-center">Relatórios de Clientes Cadastrados</h3>
        <form action="{{ route('reports.clientPdf') }}" method="get">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputState">Tipo de Relatório</label>
                    <select id="type" name='type' class="form-control" required>
                        <option value='ALL' selected>Todos Clientes</option>
                        <option value='ACTIVE'>Clientes ativos</option>
                        <option value='INACTIVE'>Clientes inativos</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Gerar PDF</button>
            <a href="{{ route('/') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
          </form>
    </div>
@endsection
