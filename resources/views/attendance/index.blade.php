@extends('index')
@section('title', 'Atendimentos')
@section('activeAtt', 'activeElement')
@section('content')
    <div class="center-content">
        <br />
        <h1 class="text-center">Atendimentos</h1>
    </div>
    <hr>
    <form class="form form-inline" action="{{ route('attendance.search') }}" method="POST">
        @csrf
        <select id="status" name='status' class="form-control" required>
            @if (isset($filters['status']))
                @switch($filters['status'])
                    @case('WAIT')
                        <option value='ALL'>Todos Atendimentos</option>
                        <option value='WAIT' selected>Em Espera</option>
                        <option value='STARTED'>Iniciado</option>
                        <option value='FINISHED'>Finalizado</option>
                        @break
                    @case('STARTED')
                        <option value='ALL'>Todos Atendimentos</option>
                        <option value='WAIT'>Em Espera</option>
                        <option value='STARTED' selected>Iniciado</option>
                        <option value='FINISHED'>Finalizado</option>
                        @break
                    @case('FINISHED')
                        <option value='ALL'>Todos Atendimentos</option>
                        <option value='WAIT'>Em Espera</option>
                        <option value='STARTED'>Iniciado</option>
                        <option value='FINISHED' selected>Finalizado</option>
                        @break
                    @default
                        <option value='ALL' selected>Todos Atendimentos</option>
                        <option value='WAIT'>Em Espera</option>
                        <option value='STARTED'>Iniciado</option>
                        <option value='FINISHED'>Finalizado</option>
                @endswitch
            @else
                <option value='ALL' selected>Todos Atendimentos</option>
                <option value='WAIT'>Em Espera</option>
                <option value='STARTED'>Iniciado</option>
                <option value='FINISHED'>Finalizado</option>
            @endif
        </select>
        <select id="collaborator" name='collaborator' class="form-control" required>
            @if (isset($filters['collaborator']))
                @if ($filters['collaborator'] == 'ALL')
                    <option value='ALL' selected>Todos Tatuadores</option>
                @else
                    <option value='ALL'>Todos Tatuadores</option>
                    @foreach ($collaborators as $collaborator)
                        @if ($filters['collaborator'] == $collaborator->id)
                            <option value='{{ $collaborator->id }}' selected>{{ $collaborator->name }}</option>
                        @else
                            <option value='{{ $collaborator->id }}'>{{ $collaborator->name }}</option>
                        @endif
                    @endforeach
                @endif
            @else
                <option value='ALL' selected>Todos Tatuadores</option>
                @foreach ($collaborators as $collaborator)
                    <option value='{{ $collaborator->id }}'>{{ $collaborator->name }}</option>
                @endforeach
            @endif
        </select>
        <div class="input-group-append">
            <button class="btn btn-info" type="submit">Pesquisar</button>
        </div>
    </form>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <table class="table-responsive table-borderless" style="font-size: 13px" width="150px">
                <tr>
                    <td>
                        <span style="color: #1E88E5;"><i class="fas fa-flag"></i>
                        </span>Esperando&nbsp
                    </td>
                    <td>
                        <span style="color: #ffc107"><i class="fas fa-flag"></i>
                        </span>Iniciado&nbsp
                    </td>
                    <td>
                        <span style="color: #28a745;"><i class="fas fa-flag"></i>
                        </span>Finalizado
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    @include('includes.alerts')
    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow" style="font-size: 13px">
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
                            <a class="btn btn-cst" href="{{ route('attendance.show', $attendance) }}" role="button" style="font-size: 13px">
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
