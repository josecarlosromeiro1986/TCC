@extends('index')
@section('title', 'Atendimentos')
@section('activeAtt', 'activeElement')
@section('content')
    <div class="center-content">
        <h5 class="display-4 text-center">Atendimentos</h5>
    </div>
    <br />
    <div>
        <table class="table table-hover table-bordered">
            <tr>
                <td class="table-info">
                    Esperando
                </td>
                <td class="table-warning">
                    Iniciado
                </td>
                <td class="table-success">
                    Finalizado
                </td>
            </tr>
        </table>
    </div>
    {{-- <form class="form form-inline" action="" method="POST">
        @csrf
        <div>
            <input class="form-control" type="text" name="filter" id="" value="{{ $filters['filter'] ?? '' }}">
        </div>
        <div class="input-group-append">
            <button class="btn btn-info" type="submit">Pesquisar</button>
        </div>
    </form> --}}
    <br />
    @include('includes.alerts')
    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow">
            <thead class="thead-dark">
                <tr>
                    <th scope="col-2" width="50">Nº</th>
                    <th scope="col-2">Tatuador</th>
                    <th scope="col-2" width="170">Data/Hora</th>
                    <th class="text-center not-mobile" scope="col-2" width="350">Opções</th>
                    <th class="text-center mobile" scope="col-2">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    @switch($attendance->status)
                        @case('WAIT')
                            <tr class="table-info">
                            @break
                        @case('STARTED')
                            <tr class="table-warning">
                            @break
                        @case('FINISHED')
                            <tr class="table-success">
                            @break
                        @default
                            <tr>
                    @endswitch
                        <td>{{ $attendance->id }}</td>
                        <td>{{ $attendance->collaborator }}</td>
                        <td>{{ $attendance->start }}</td>
                        <td class="text-center not-mobile">
                            <a class="btn btn-cst" href="{{ route('attendance.show', $attendance) }}" role="button">
                                <i class="far fa-id-card"></i>&nbspDetalhes
                            </a>
                        </td>
                        <td class="text-center mobile">
                            <div class="dropdown">
                                <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-list"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a class="dropdown-item text-center bg-cst text-white" name="" id=""
                                        href="{{ route('attendance.show', $attendance) }}" role="button">
                                        <i class="far fa-id-card"></i>&nbspDetalhes
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    @if (isset($filters))
        {!! $attendances->appends($filters)->links() !!}
    @else
        {!! $attendances->links() !!}
    @endif
    <a href="{{ route('home') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
@endsection
