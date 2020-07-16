@extends('index')
@section('title', 'Tipos de Telefone')
@section('activeTypePhone', 'activeElement')
@section('content')
    <div class="center-content">
        <h5 class="display-4 text-center">Tipos de Telefone</h5>
        <a href="{{ route('typePhone.create') }}" class="btn btn-cst btn-block shadow" role="button" aria-pressed="true"><i class="fas fa-plus"></i>&nbspTipo de Telefone</a>
        <br />
        <br />
        @include('includes.alerts')
        @csrf
        <div class="table-responsive">
            <table class="table table-hover shadow">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col-2">Descrição</th>
                    <th class="text-center not-mobile" scope="col-2" width="250">Opções</th>
                    <th class="text-center mobile" scope="col-2">Opções</th>
                    </tr>
                </thead>
                <tbody>            
                    @foreach ($typePhones as $typePhone)
                        <tr>
                            <td>{{ $typePhone->description }}</td>
                            <td class="text-center table-buttons not-mobile">
                                <a class="btn btn-info text-white" href="{{ route('typePhone.edit', $typePhone) }}" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                                <a class="btn btn-danger text-white" data-toggle="modal" data-target="#delete" role="button"><i class="fas fa-pencil-alt"></i>&nbspExcluir</a>
                            </td>
                            <td class="text-center mobile">
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <div class="dropdown-menu bg-dark text-white" aria-labelledby="dropdownMenu2">
                                        <a class="dropdown-item text-center bg-info text-white" name="" id="" href="{{ route('typePhone.edit', $typePhone) }}" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                                        <a class="dropdown-item text-center bg-danger text-white" data-toggle="modal" data-target="#delete" role="button"><i class="fas fa-trash-alt"></i>&nbspExcluir</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content bk-color text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Excluir Tipo de Telefone</h5>
                </div>
                <form action="{{ route('typePhone.destroy', $typePhone ?? '') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-white">
                        <p class="text-center">
                            Tem certeza que deseja excluir: {{ $typePhone->description ?? ''}}?
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
    @if (isset($filters))
        {!! $typePhones->appends($filters)->links() !!}
    @else        
        {!! $typePhones->links() !!}
    @endif
@endsection