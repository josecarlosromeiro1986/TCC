@extends('index')
@section('title', 'Relatórios')
@section('activeRep', 'activeElement')
@section('content')
    <div class="center-content">
        <br />
        <h3 class="text-center">Relatórios de Estoque</h3>
        @include('includes.alerts')
        <hr>
        <form action="{{ route('reports.stockPdf') }}" method="get">
            @csrf
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="checkbox" type="radio" value="ALL" id="all">
                <label class="form-check-label" for="all">Estoque Total</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="checkbox" type="radio" value="PAT" id="pat">
                <label class="form-check-label" for="pat">Patrimônio</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="checkbox" type="radio" value="INS" id="ins">
                <label class="form-check-label" for="ins">Insumo</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="checkbox" type="radio" value="ATT" id="att">
                <label class="form-check-label" for="att">Insumo por Atendimento</label>
            </div>
            <hr>
            <button type="submit" class="btn btn-cst btn-block">Gerar PDF</button>
            <a href="{{ route('/') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
          </form>
    </div>
@endsection
