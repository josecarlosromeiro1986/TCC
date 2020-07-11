@extends('index')
@section('title', 'Cargos')
@section('activeOffice', 'activeElement')
@section('content')
    <div class="center-content">
        <h5 class="display-4 text-center">Cargos</h5>
        <a href="{{ route('office.create') }}" class="btn btn-primary btn-block shadow" role="button" aria-pressed="true"><i class="fas fa-plus"></i>&nbspCargo</a>
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
    @include('includes.alerts')
    @csrf
    <table class="table table-hover shadow">
        <thead class="thead-dark">
            <tr>
            <th scope="col-2">Descrição</th>
            <th scope="col-2">Acesso</th>
            <th class="text-center not-mobile" scope="col-2" width="350">Opções</th>
            <th class="text-center mobile" scope="col-2">Opções</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($offices as $office)                    
                <tr>
                    <td>{{ $office->description }}</td>
                    <td>{{ $office->access }}</td>
                    <td class="text-center table-buttons not-mobile">
                        <a class="btn btn-info" href="{{ route('office.edit', $office) }}" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                        <form action="{{ route('office.destroy', $office->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>&nbspExcluir
                            </button>
                        </form>
                    </td>
                    <td class="text-center mobile">
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-list"></i>
                            </button>
                            <div class="dropdown-menu bg-dark text-white" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item text-center bg-info text-white" name="" id="" href="{{ route('office.edit', $office) }}" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                                <a class="dropdown-item text-center bg-danger text-white" name="" id="" href="{{ route('office.destroy', $office->id) }}" role="button"><i class="fas fa-trash-alt"></i>&nbspExcluir</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (isset($filters))
        {!! $offices->appends($filters)->links() !!}        
    @else        
        {!! $offices->links() !!}
    @endif
@endsection