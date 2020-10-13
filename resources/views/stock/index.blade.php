@extends('index')
@section('title', 'Estoque')
@section('activeStock', 'activeElement')
@section('content')
    <br />
    <h1 class="text-center">Estoque</h1>
    @include('includes.alerts')
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-center">Patrimônio</h4>
            <a class="btn btn-cst text-white btn-block" data-toggle="modal" data-target="#createEquip" role="button">Adicionar Patrimônio</a>
            <br />
            <table class="table table-bordered" style="font-size: 14px;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center" width="30px">ID</th>
                        <th scope="col" width="35%">Nome</th>
                        <th scope="col">Local/Responsável</th>
                        <th scope="col" class="text-center" width="30px"><i class="fas fa-tools"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipments as $equipment)
                        <tr>
                            <td class="text-center">{{ $equipment->id }}</td>
                            <td>{{ $equipment->name }}</td>
                            @if (is_null($equipment->collaborator_id))
                                <td>Em Estoque</td>
                            @else
                                <td>{{ $equipment->collaborator }}</td>
                            @endif
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="font-size: 13px; padding: 0;">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="min-width: 0; padding: 0;">
                                        <a class="dropdown-item text-center" data-toggle="modal"
                                            data-target="#editEquip{{ str_replace(' ', '', $equipment->id) }} "role="button">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="dropdown-item text-center" data-toggle="modal"
                                            data-target="#deleteEquip{{ str_replace(' ', '', $equipment->id) }}" role="button">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Edit-->
                        <div class="modal fade" id="editEquip{{ str_replace(' ', '', $equipment->id) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-site">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Editar Patrimônio</h5>
                                    </div>
                                    <form action="{{ route('equipment.update', $equipment) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nome</label>
                                                <input type="text" class="form-control shadow-sm" name="name" id="name" value="{{ $equipment->name ?? old('name') }}" required>
                                            </div>
                                            <label for="collaborator_id">Tatuador</label>
                                            <select name="collaborator_id" id="collaborator_id" class="form-control shadow-sm">
                                                @if (is_null($equipment->collaborator_id))
                                                    <option selected value="">Manter no Estoque</option>
                                                @else
                                                    <option value="">Manter no Estoque</option>
                                                @endif
                                                @foreach ($collaborators as $collaborator)
                                                    @if ($collaborator->id == $equipment->collaborator_id)
                                                        <option selected value="{{ $collaborator->id }}">{{ $collaborator->name }}</option>
                                                    @else
                                                        <option value="{{ $collaborator->id }}">{{ $collaborator->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="form-group">
                                                <label for="description">Descrição</label>
                                                <textarea class="form-control shadow-sm" name="description" id="description" rows="3">{{ $equipment->description ?? old('description') }}</textarea>
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
                        <div class="modal fade" id="deleteEquip{{ str_replace(' ', '', $equipment->id) }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content bg-cst text-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Excluir Patrimônio</h5>
                                    </div>
                                    <form action="{{ route('equipment.destroy', $equipment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body bg-modal text-white">
                                            <p class="text-center">
                                                Tem certeza que deseja excluir: {{ $equipment->name }}?
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
        <div class="col-md-6">
            <h4 class="text-center">Insumo</h4>
            <a class="btn btn-cst text-white btn-block" data-toggle="modal" data-target="#createProd" role="button">Adicionar Insumo</a>
            <br />
            <table class="table table-bordered" style="font-size: 14px;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center" width="30px">ID</th>
                        <th scope="col" class="text-center" width="80px">Total</th>
                        <th scope="col">Nome</th>
                        <th scope="col" width="100">Validade</th>
                        <th scope="col" class="text-center" width="30px"><i class="fas fa-tools"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="text-center">{{ $product->id }}</td>
                                @if ($product->quantity <= 5)
                                    <td class="text-center">
                                        <span style="color: #FF0000;"><i class="fas fa-exclamation"></i>
                                        </span>&nbsp{{ $product->quantity }}
                                    </td>
                                @else
                                    <td class="text-center">{{ $product->quantity }}</td>
                                @endif
                            <td>{{ $product->name }}</td>
                            @if (is_null($product->due))
                                <td>__/__/____</td>
                            @else
                                <td>{{ date('d/m/Y', strtotime($product->due)) }}</td>
                            @endif
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="font-size: 13px; padding: 0;">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="min-width: 0; padding: 0;">
                                        <a class="dropdown-item text-center" data-toggle="modal"
                                            data-target="#editProd{{ str_replace(' ', '', $product->id) }} "role="button">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="dropdown-item text-center" data-toggle="modal"
                                            data-target="#deleteProd{{ str_replace(' ', '', $product->id) }}" role="button">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Edit-->
                        <div class="modal fade" id="editProd{{ str_replace(' ', '', $product->id) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-site">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Editar Produto</h5>
                                    </div>
                                    <form action="{{ route('product.update', $product) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nome</label>
                                                <input type="text" class="form-control shadow-sm" name="name" id="name" value="{{ $product->name ?? old('name') }}" required>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="quantity">Quantidade</label>
                                                    <input type="number" min="0" class="form-control shadow-sm" name="quantity" id="quantity" value="{{ $product->quantity ?? old('number') }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="due">Validade</label>
                                                    <input type="date" class="form-control shadow-sm" name="due" id="due" value="{{ $product->due ?? old('due') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Descrição</label>
                                                <textarea class="form-control shadow-sm" name="description" id="description" rows="3">{{ $product->description ?? old('description') }}</textarea>
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
                        <div class="modal fade" id="deleteProd{{ str_replace(' ', '', $product->id) }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content bg-cst text-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Excluir Insumo</h5>
                                    </div>
                                    <form action="{{ route('product.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body bg-modal text-white">
                                            <p class="text-center">
                                                Tem certeza que deseja excluir: {{ $product->name }}?
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
    </div>
    <hr>
    <div class="center-content">
        <a href="{{ route('/') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
    </div>

    <!-- Modal Create Equip-->
    <div class="modal fade" id="createEquip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-site">
                <div class="modal-header">
                <h5 class="modal-title">Adicionar Patrimônio</h5>
                </div>
                <form action="{{ route('equipment.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control shadow-sm" name="name" id="name" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control shadow-sm" name="description" id="description" rows="3" required></textarea>
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

    <!-- Modal Create Prod-->
    <div class="modal fade" id="createProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-site">
                <div class="modal-header">
                <h5 class="modal-title">Adicionar Patrimônio</h5>
                </div>
                <form action="{{ route('product.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control shadow-sm" name="name" id="name" value="" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="quantity">Quantidade</label>
                                <input type="number" min="0" class="form-control shadow-sm" name="quantity" id="quantity" value="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="due">Validade</label>
                                <input type="date" class="form-control shadow-sm" name="due" id="due" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control shadow-sm" name="description" id="description" rows="3" required></textarea>
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
