@extends('index')
@section('title', 'Usuários')
@section('activeUser', 'activeElement')
@section('content')
    <h5 class="display-4">Usuários</h5>
    <a href="{{ route('collaborator.create') }}" class="btn btn-cst btn-lg shadow" role="button" aria-pressed="true"><i class="fas fa-plus"></i>&nbspUsuário</a>
    <br><br>
    <h5>Lista de usuários</h5>
    <table class="table table-hover shadow">
        <thead>
            <tr>
            <th class="not-mobile" scope="col-2">Cargo</th>
            <th scope="col-2">Nome</th>
            <th scope="col-2">Telefone</th>
            <th class="not-mobile" scope="col-2">E-mail</th>
            <th class="text-center not-mobile" scope="col-2" width="350">Opções</th>
            <th class="text-center mobile" scope="col-2">Opções</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($collaborators as $collaborator) 
                <tr>
                    <td class="not-mobile">{{ $collaborator->office }}</td>
                    <td>{{ $collaborator->name }}</td>
                    <td>{{ $collaborator->phone }}</td>
                    <td class="not-mobile">{{ $collaborator->email }}</td>
                    <td class="text-center not-mobile">
                        <a class="btn btn-info" href="" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                        <a class="btn btn-danger text-white" data-toggle="modal" data-target="#delete" role="button"><i class="fas fa-pencil-alt"></i>&nbspExcluir</a>
                        <a class="btn btn-cst" href="" role="button"><i class="far fa-id-card"></i>&nbspDetalhes</a>
                    </td>
                    <td class="text-center mobile">
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-list"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" name="" id="" class="btn" href="#" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                                <a class="dropdown-item" name="" id="" class="btn" href="#" role="button"><i class="fas fa-trash-alt"></i>&nbspExcluir</a>
                                <a class="dropdown-item" name="" id="" class="btn" href="show" role="button"><i class="far fa-id-card"></i>&nbspDetalhes</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection