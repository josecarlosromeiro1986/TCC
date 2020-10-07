@extends('index')
@section('title', 'Atendimento')
@section('activeAtt', 'activeElement')
@section('content')
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
    <div class="row">
        <div class="col-md-12">
            <form class="needs-validation" action="{{ route('attendance.update', $attendance->id) }}" method="post">
                @method('PUT')
                @csrf
                {{-- <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="note">Observações</label>
                    <textarea class="form-control shadow-sm" name="note" id="note" rows="3">{{ $attendance->note }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            </form>
        </div>
    </div>
    <hr class="not-mobile">
    <br class="mobile"/>
    <a href="{{ route('attendance.index') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
@endsection
