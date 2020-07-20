@extends('index')
@section('title', 'Atendimentos')
@section('activeAtt', 'activeElement')
@section('content')    
    <div class="center-content">
        <h5 class="display-4 text-center">Atendimentos</h5>
        <a href="{{ route('attendance.create') }}" class="btn btn-cst btn-block shadow" role="button" aria-pressed="true">
            <i class="fas fa-plus"></i>&nbspAtendimento
        </a>
    </div>
    <br />
    <form class="form form-inline" action="{{-- {{ route('client.search') }} --}}" method="POST">
        @csrf
        <div>
            <input class="form-control" type="text" name="filter" id="" value="{{ $filters['filter'] ?? '' }}">
        </div>
        <div class="input-group-append">
            <button class="btn btn-info" type="submit">Pesquisar</button>
        </div>
    </form>
    <br />
    @include('includes.alerts')
    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow">
            <thead class="thead-dark">
                <tr>
                    <th scope="col-2">Número</th>
                    <th scope="col-2">Tatuador</th>
                    <th scope="col-2">Cliente</th>
                    <th class="text-center not-mobile" scope="col-2" width="350">Opções</th>
                    <th class="text-center mobile" scope="col-2">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->id }}</td>
                        <td>{{ $attendance->collaborator }}</td>
                        <td class="not-mobile">{{ $attendance->client }}</td>
                        <td class="text-center not-mobile">
                            <a class="btn btn-info" href="{{ route('attendance.edit', $attendance) }}" role="button">
                                <i class="fas fa-pencil-alt"></i>&nbspEditar
                            </a>
                            <a class="btn btn-danger text-white" data-toggle="modal" data-target="#delete{{ str_replace(' ', '', $attendance->id) }}" role="button">
                                <i class="fas fa-pencil-alt"></i>&nbspExcluir
                            </a>
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
                                    <a class="dropdown-item text-center bg-info text-white" name="" id=""
                                        href="{{ route('attendance.edit', $attendance) }}" role="button">
                                        <i class="fas fa-pencil-alt"></i>&nbspEditar
                                    </a>
                                    <a class="dropdown-item text-center bg-danger text-white" data-toggle="modal"
                                        data-target="#delete{{ str_replace(' ', '', $attendance->id) }}" role="button">
                                        <i class="fas fa-trash-alt"></i>&nbspExcluir
                                    </a>
                                    <a class="dropdown-item text-center bg-cst text-white" name="" id=""
                                        href="{{ route('attendance.show', $attendance) }}" role="button">
                                        <i class="far fa-id-card"></i>&nbspDetalhes
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Delete-->
                    <div class="modal fade" id="delete{{ str_replace(' ', '', $attendance->id) }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content bg-cst text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Excluir Atendimento</h5>
                                </div>
                                <form action="{{ route('attendance.destroy', $attendance) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body bg-modal text-white">
                                        <p class="text-center">
                                            Tem certeza que deseja excluir o atendimento: {{ $attendance->id }}?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Sim, Confirmar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não, Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
        <a href="{{ route('home') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
    </div>    
@endsection