@extends('index')
@section('title', 'Usuários')
@section('activeUser', 'activeElement')
@section('content')
    <br class="mobile"/>
    <hr class="not-mobile">
    <div class="row not-mobile">
        <div class="col-md-3">
            <h5>Cargo:&nbsp</h5>
            <p>{{ $collaborator->office }}</p>
        </div>
        <div class="col-md-3">
            <h5>Data de inicio:&nbsp</h5>
            <p>{{ $collaborator->start }}</p>
        </div>
        <div class="col-md-3">
            <h5>Data saída:&nbsp</h5>
            <p>{{ $collaborator->exit ?? '' }}</p>
        </div>
        <div class="col-md-3">
            <h5>Status:&nbsp</h5>
            <p>
                @if ($collaborator->active === 'Y')
                    Ativo
                @else
                    Inativo
                @endif
            </p>
        </div>
    </div>
    <hr class="not-mobile">
    @include('includes.alerts')
    <div class="row mobile">
        <div class="col">
            <div class="card shadow">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Cargo:&nbsp</strong>{{ $collaborator->office }}</li>
                    <li class="list-group-item"><strong>Data de inicio:&nbsp</strong>{{ $collaborator->start }}</li>
                    <li class="list-group-item"><strong>Data saída:&nbsp</strong>{{ $collaborator->exit ?? '' }}</li>
                    <li class="list-group-item"><strong>Status:&nbsp</strong>
                        @if ($collaborator->active === 'Y')
                            Ativo
                        @else
                            Inativo
                        @endif
                    </li>
                </ul>
            </div>
            <br />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5><i class="far fa-address-card"></i><strong>&nbspDados Pessoais</strong></h5>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nome:&nbsp</strong>{{ $collaborator->name }}</li>
                    <li class="list-group-item"><strong>CPF:&nbsp</strong>{{ $collaborator->cpf }}</li>
                    <li class="list-group-item"><strong>rg:&nbsp</strong>{{ $collaborator->rg }}</li>
                    <li class="list-group-item"><strong>Data de nascimento:&nbsp</strong>{{ $collaborator->birth }}</li>
                    <li class="list-group-item"><i class="far fa-envelope"></i><strong>&nbspEmail:&nbsp</strong>{{ $collaborator->email }}</li>
                </ul>
            </div>
            <br />
            <div class="card shadow">
                <div class="card-header">
                    <h5><i class="fas fa-house-user"></i><strong>&nbspEndereço</strong></h5>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>CEP:&nbsp</strong>{{ $collaborator->cep }}</li>
                    <li class="list-group-item"><strong>Estado:&nbsp</strong>{{ $collaborator->state }}</li>
                    <li class="list-group-item"><strong>Cidade:&nbsp</strong>{{ $collaborator->city }}</li>
                    <li class="list-group-item"><strong>Bairro:&nbsp</strong>{{ $collaborator->neighborhood }}</li>
                    <li class="list-group-item"><strong>Rua:&nbsp</strong>{{ $collaborator->address }}</li>
                    <li class="list-group-item"><strong>Número:&nbsp</strong>{{ $collaborator->number }}</li>
                    <li class="list-group-item"><strong>Complemento:&nbsp</strong>{{ $collaborator->complement ?? '' }}</li>
                </ul>                
            </div>
            <br />
        </div>        
        <div class="col-md-6">            
            <div class="card shadow">
                <div class="card-header">
                    <h5><i class="fas fa-phone-alt"></i></i><strong>&nbspTelefone</strong></h5>
                </div>
                <table class="table table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Número</th>
                            <th scope="col">Nome</th>
                            <th class="text-center" scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phones as $phone)
                            <tr>
                                <th>{{ $phone->number }}</th>
                                <td>{{ $phone->contact }}</td>
                                <td class="text-center not-mobile">
                                    <a class="btn btn-info text-white" data-toggle="modal" data-target="#edit{{ str_replace(' ', '', $phone->id) }}" role="button" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger text-white" data-toggle="modal" data-target="#delete{{ str_replace(' ', '', $phone->id) }}" role="button" title="Excluir"><i class="far fa-trash-alt"></i></a>
                                </td>                                
                                <td class="text-center mobile">
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-list"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <a class="dropdown-item text-center bg-info text-white" data-toggle="modal"
                                                data-target="#edit{{ str_replace(' ', '', $phone->id) }}" role="button">
                                                <i class="fas fa-pencil-alt"></i>&nbspEditar
                                            </a>
                                            <a class="dropdown-item text-center bg-danger text-white" data-toggle="modal"
                                                data-target="#delete{{ str_replace(' ', '', $phone->id) }}" role="button">
                                                <i class="fas fa-trash-alt"></i>&nbspExcluir
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit-->
                            <div class="modal fade" id="edit{{ str_replace(' ', '', $phone->id) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-site">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Editar Telefone</h5>
                                        </div>
                                        <form action="{{ route('phone.update', $phone->id) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="phone">Telefone</label>
                                                    <input type="text" class="form-control shadow-sm phone" name="phone" id="phone" value="{{ $phone->number ?? old('description') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact">Contato</label>
                                                    <input type="text" class="form-control shadow-sm" name="contact" id="contact" value="{{ $phone->contact ?? old('description') }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-cst">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete-->
                            <div class="modal fade" id="delete{{ str_replace(' ', '', $phone->id) }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-cst text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Excluir Telefone</h5>
                                        </div>
                                        <form action="{{ route('phone.destroy', $phone) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body bg-modal text-white">
                                                <p class="text-center">
                                                    Tem certeza que deseja excluir: {{ $phone->contact }}?
                                                </p>
                                                <p class="text-center">
                                                    Número: {{ $phone->number }}.
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
                <a class="btn btn-cst text-white" data-toggle="modal" data-target="#create" role="button"><i class="fas fa-plus"></i>&nbspTelefone</a>
            </div>
            {!! $phones->links() !!}
            <div class="card shadow">
                <div class="card-header">
                    <h5><i class="far fa-clipboard"></i><strong>&nbspObservações</strong></h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $collaborator->note ?? '' }}</p>
                </div>
            </div>                       
        </div>
    </div>
    <br />
    <div class="row">
    </div>
    <div class="center-content">
        <a href="{{ route('collaborator.index') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
    </div>
    <!-- Modal Create-->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-site">
                <div class="modal-header">
                <h5 class="modal-title">Adicionar Novo Telefone</h5>
                </div>
                <form action="{{ route('phone.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control shadow-sm phone" name="phone" id="phone" value="" required>
                            <input type="hidden" id="collaborator_id" name="collaborator_id" value="{{ $collaborator->id }}">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contato</label>
                            <input type="text" class="form-control shadow-sm" name="contact" id="contact" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-cst">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection