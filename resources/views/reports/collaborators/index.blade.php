@extends('index')
@section('title', 'Relatórios')
@section('activeRep', 'activeElement')
@section('content')
    <div class="center-content">
        <h3 class=" text-center">Relatório de Colaboradores Cadastrados</h3>
        <form action="{{ route('reports.pdf') }}" method="get">
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
            <button type="submit" class="btn btn-primary btn-block">Gerar PDF</button>
            <a href="" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
          </form>
    </div>
@endsection
