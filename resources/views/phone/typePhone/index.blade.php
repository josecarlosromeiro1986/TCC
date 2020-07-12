@extends('index')
@section('title', 'Cargos')
@section('activeTypePhone', 'activeElement')
@section('content')
    <div class="center-content">
        <h5 class="display-4 text-center">Tipo de Telefone</h5>
        <a href="{{ route('typePhone.create') }}" class="btn btn-primary btn-block shadow" role="button" aria-pressed="true"><i class="fas fa-plus"></i>&nbspTipo de Telefone</a>    
        <br />
        <br />
        @include('includes.alerts')
        @csrf
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
                            <a class="btn btn-info" href="{{ route('typePhone.edit', $typePhone) }}" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                            <form action="{{ route('typePhone.destroy', $typePhone->id) }}" method="POST">
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
                                    <a class="dropdown-item text-center bg-info text-white" name="" id="" href="{{ route('typePhone.edit', $typePhone) }}" role="button"><i class="fas fa-pencil-alt"></i>&nbspEditar</a>
                                    <a class="dropdown-item text-center bg-danger text-white" name="" id="" href="{{ route('typePhone.destroy', $typePhone->id) }}" role="button"><i class="fas fa-trash-alt"></i>&nbspExcluir</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (isset($filters))
        {!! $typePhones->appends($filters)->links() !!}        
    @else        
        {!! $typePhones->links() !!}
    @endif
@endsection