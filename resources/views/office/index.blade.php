@extends('index')
@section('title', 'Cargos')
@section('activeOffice', 'activeElement')
@section('content')
    @include('includes.alerts')
    <div class="center-content">
        <h5 class="display-4 text-center">Cargos</h5>
        <a href="{{ route('office.create') }}" class="btn btn-cst btn-block shadow" role="button" aria-pressed="true">
            <i class="fas fa-plus"></i>&nbspCargo
        </a>
    </div>
    <br />
    <form class="form form-inline" action="{{ route('office.search') }}" method="POST">
        @csrf
        <div>
            <input class="form-control" type="text" name="filter" id="" value="{{ $filters['filter'] ?? '' }}">
        </div>
        <div class="input-group-append">
            <button class="btn btn-info" type="submit">Pesquisar</button>
        </div>
    </form>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered shadow">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Descrição</th>
                    <th scope="col">Acesso</th>
                    <th class="text-center not-mobile" scope="col" width="250">Opções</th>
                    <th class="text-center mobile" scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offices as $office)
                    <tr>
                        <td>{{ $office->description }}</td>
                        <td>{{ $office->access }}</td>
                        <td class="text-center table-buttons not-mobile">
                            <a class="btn btn-info" href="{{ route('office.edit', $office) }}" role="button">
                                <i class="fas fa-pencil-alt"></i>&nbspEditar
                            </a>
                            <a class="btn btn-danger text-white" data-toggle="modal" data-target="#delete" role="button">
                                <i class="fas fa-pencil-alt"></i>&nbspExcluir
                            </a>
                        </td>
                        <td class="text-center mobile">
                            <div class="dropdown">
                                <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-list"></i>
                                </button>
                                <div class="dropdown-menu bg-dark text-white" aria-labelledby="dropdownMenu2">
                                    <a class="dropdown-item text-center bg-info text-white" name="" id=""
                                        href="{{ route('office.edit', $office) }}" role="button">
                                        <i class="fas fa-pencil-alt"></i>&nbspEditar
                                    </a>
                                    <a class="dropdown-item text-center bg-danger text-white" data-toggle="modal"
                                        data-target="#delete" role="button">
                                        <i class="fas fa-trash-alt"></i>&nbspExcluir
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
        {!! $offices->appends($filters)->links() !!}
    @else
        {!! $offices->links() !!}
    @endif

    <div class="center-content">
        <a href="{{ route('/') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content bg-cst text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Excluir Cargo</h5>
                </div>
                <form action="{{ route('office.destroy', $office ?? '') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body bg-modal text-white">
                        <p class="text-center">
                            Tem certeza que deseja excluir: {{ $office->description ?? ''}}?
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
@endsection
