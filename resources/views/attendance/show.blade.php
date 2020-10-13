@extends('index')
@section('title', 'Atendimento')
@section('activeAtt', 'activeElement')
@section('content')
<div class="center-content">
    <br class="mobile"/>
    <hr class="not-mobile">
        @switch($attendance->status)
        @case('WAIT')
            <a href="{{ route('attendance.status', ['attendance_status' => 'STARTED', 'attendance_id' => $attendance->id]) }}" type="button" class="btn btn-success btn-block">Iniciar</a>
            @break
        @case('STARTED')
            <a href="{{ route('attendance.status', ['attendance_status' => 'FINISHED', 'attendance_id' => $attendance->id]) }}" type="button" class="btn btn-warning btn-block">Finalizar</a>
            @break
        @default
            <h5 class="text-center"><strong>Atendimento Finalizado</strong></h5>
        @endswitch
    <hr class="not-mobile">
    <br class="mobile"/>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5><i class="far fa-address-card"></i><strong>&nbspDados Atendimento Nº {{ $attendance->id }}</strong></h5>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Tatuador:&nbsp</strong>{{ $attendance->collaborator }}</li>
                    <li class="list-group-item"><strong>Cliente:&nbsp</strong>{{ $attendance->client }}</li>
                    <li class="list-group-item"><strong>Status:&nbsp</strong>
                        @switch($attendance->status)
                        @case('WAIT')
                            Esperando
                            @break
                        @case('STARTED')
                            Iniciado
                            @break
                        @case('FINISHED')
                            Finalizado
                            @break
                        @default
                            Indefinido
                        @endswitch
                    </li>
                    <li class="list-group-item"><strong>Data/Hora de inicio:&nbsp</strong>{{ date('d/m/Y H:m:s', strtotime($attendance->start)) }}</li>
                    <li class="list-group-item"><strong>Data/Hora de termino:&nbsp</strong>{{ date('d/m/Y H:m:s', strtotime($attendance->end)) }}</li>
                </ul>
            </div>
            <hr>
        </div>
    </div>
    <a class="btn btn-cst text-white btn-block" data-toggle="modal" data-target="#addProd" role="button">Adicionar Insumo</a>
    <hr>
    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-bordered table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th class="col-8">Insumo</th>
                    <th class="col-4">Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prodAtts as $prodAtt)
                    <tr>
                        <td class="col-8">{{ $prodAtt->name }}</td>
                        <td class="col-4 text-center">{{ $prodAtt->quantity_product }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <form class="needs-validation" action="{{ route('attendance.update', $attendance->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="note">Observações</label>
                    <textarea class="form-control shadow-sm" name="note" id="note" rows="3">{{ $attendance->note }}</textarea>
                </div>
                <button type="submit" class="btn btn-cst btn-block">Salvar</button>
            </form>
        </div>
    </div>
    <hr class="not-mobile">
    <br class="mobile"/>
    <a href="{{ route('attendance.index') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
</div>

<!-- Modal Add Prod-->
<div class="modal fade" id="addProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-site">
            <div class="modal-header">
            <h5 class="modal-title">Adicionar Patrimônio</h5>
            </div>
            <form action="{{ route('product.move') }}" method="post">
                <input type="hidden" name="attendance" id="attendance" value="{{ $attendance->id }}" >
                @csrf
                <div class="modal-body">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th scope="col">Insumo</th>
                            <th scope="col" width="100px">Qtd</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" name="{{ $product->id }}[0]" type="checkbox" value="{{ $product->id }}" id="{{ $product->id }}">
                                        <label class="form-check-label" for="{{ $product->id }}">{{ $product->name }}</label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-group" style="margin-bottom: 0; padding: 0; width: 80px;">
                                        <input type="number" min="0" max="{{ $product->quantity }}" class="form-control shadow-sm" name="{{ $product->id }}[1]" id="{{ $product->id }}" value="">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-cst">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
