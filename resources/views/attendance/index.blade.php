@extends('index')
@section('title', 'Atendimentos')
@section('activeAtt', 'activeElement')
@section('content')
    <div class="center-content">
        <h5 class="display-4 text-center">Atendimentos</h5>
    </div>
    <br />
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <table class="table table-hover table-bordered">
                <tr>
                    <td class="text-center">
                        <span style="color: #1E88E5;"><i class="fas fa-flag"></i>
                        </span>Esperando
                    </td>
                    <td class="text-center">
                        <span style="color: #ffc107"><i class="fas fa-flag"></i>
                        </span>Iniciado
                    </td>
                    <td class="text-center">
                        <span style="color: #28a745;"><i class="fas fa-flag"></i>
                        </span>Finalizado
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-3"></div>
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
                    <th class="text-center" scope="col-2" width="50"></th>
                    <th class="text-center" scope="col-2" width="100">Nº</th>
                    <th scope="col-2">Tatuador</th>
                    <th scope="col-2" width="170">Data/Hora</th>
                    <th class="text-center not-mobile" scope="col-2" width="350">Opções</th>
                    <th class="text-center mobile" scope="col-2">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        @switch($attendance->status)
                        @case('WAIT')
                            <td class="text-center"><span style="color: #1E88E5;"><i class="fas fa-flag"></i></span></td>
                            <td class="text-center">{{ $attendance->id }}</td>
                            @break
                        @case('STARTED')
                            <td class="text-center"><span style="color: #ffc107;"><i class="fas fa-flag"></i></span></td>
                            <td class="text-center">{{ $attendance->id }}</td>
                            @break
                        @case('FINISHED')
                            <td class="text-center"><span style="color: #28a745;"><i class="fas fa-flag"></i></span> </td>
                            <td class="text-center">{{ $attendance->id }}</td>
                            @break
                        @default
                            <td class="text-center"></td>
                            <td>{{ $attendance->id }}</td>
                        @endswitch
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
    <div class="center-content">
        <a href="{{ route('/') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
    </div>
@endsection
