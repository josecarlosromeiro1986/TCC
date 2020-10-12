@include('includes.alerts')
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <input type="text" class="form-control shadow-sm" name="name" id="name" value="{{ $collaborator->name ?? old('name') }}" required>
            <div class="invalid-feedback">
                O Nome é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="email" class="form-control shadow-sm" name="email" id="email" value="{{ $collaborator->email ?? old('email') }}" required>
            <div class="invalid-feedback">
                O E-mail é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control shadow-sm cpf" name="cpf" id="cpf" value="{{ $collaborator->cpf ?? old('cpf') }}" required>
            <div class="invalid-feedback">
                O CPF é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="rg">RG</label>
            <input type="text" class="form-control shadow-sm rg" name="rg" id="rg" value="{{ $collaborator->rg ?? old('rg') }}" required>
            <div class="invalid-feedback">
                O RG é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="phone">Telefone</label>
            @if (isset($phone))
                <input type="hidden" id="phone_id" name="phone_id" value="{{ $phone->id }}">
            @endif
            <input type="text" class="form-control shadow-sm phone" name="phone" id="phone" value="{{ $phone->number ?? old('phone') }}" required>
            <div class="invalid-feedback">
                O Telefone é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="birth">Data de Nascimento</label>
            <input type="date" class="form-control shadow-sm" name="birth" id="birth" value="{{ $collaborator->birth ?? old('birth') }}" required>
            <div class="invalid-feedback">
                A Data de Nascimento é Obrigatória!
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="office_id">Cargo</label>
            <select name="office_id" id="office_id" class="form-control shadow-sm" placeholder="Selecione o cargo:"
                required>
                @if (!isset($collaborator->office_id))
                    <option selected disabled value="">Selecione o cargo:</option>
                @endif
                @foreach ($offices as $office)
                    @if (isset($collaborator->office_id) && $collaborator->office_id === $office->id)
                        <option value="{{ $office->id }}" selected>{{ $office->description }}</option>
                    @else
                        <option value="{{ $office->id }}">{{ $office->description }}</option>
                    @endif
                @endforeach
            </select>
            <div class="invalid-feedback">
                O Cargo é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="start">Data de Início</label>
            <input type="date" class="form-control shadow-sm" name="start" id="start" value="{{ $collaborator->start ?? old('start') }}" required>
            <div class="invalid-feedback">
                A Data de Início é Obrigatória!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="cep">CEP</label>
                <div id="loading" class=""></div>
            <input class="form-control shadow-sm cep" name="cep" type="text" id="cep" value="{{ $collaborator->cep ?? old('cep') }}" size="10" maxlength="9"
                onblur="pesquisacep(this.value);" required>
            <div class="invalid-feedback">
                O CEP é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="address">Endereço</label>
            <input type="text" class="form-control shadow-sm" name="address" id="address" value="{{ $collaborator->address ?? old('address') }}" required>
            <div class="invalid-feedback">
                O Endereço é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="complement">Complemento</label>
            <input type="text" class="form-control shadow-sm" name="complement" id="complement" value="{{ $collaborator->complement ?? old('complement') }}">
        </div>
        <div class="form-group col-md-2">
            <label for="number">Número</label>
            <input type="number" class="form-control shadow-sm" name="number" id="number" value="{{ $collaborator->number ?? old('number') }}" required>
            <div class="invalid-feedback">
                O Número é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="neighborhood">Bairro</label>
            <input type="text" class="form-control shadow-sm" name="neighborhood" id="neighborhood" value="{{ $collaborator->neighborhood ?? old('neighborhood') }}" required>
            <div class="invalid-feedback">
                O Bairro é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="state">Estado</label>
            <input type="text" class="form-control shadow-sm" name="state" id="state" value="{{ $collaborator->state ?? old('state') }}" required>
            <div class="invalid-feedback">
                O Estado é Obrigatório!
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="city">Cidade</label>
            <input type="text" class="form-control shadow-sm" name="city" id="city" value="{{ $collaborator->city ?? old('city') }}" required>
            <div class="invalid-feedback">
                A Cidade é Obrigatória!
            </div>
        </div>
        @if (!isset($collaborator))
            <div class="form-group col-md-6">
                <label for="password">Senha</label>
                <input type="password" class="form-control shadow-sm" name="password" id="password" value="{{ old('password') }}" required>
                <div class="invalid-feedback">
                    A Senha é Obrigatória!
                </div>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="note">Observações</label>
        <textarea class="form-control shadow-sm" name="note" id="note" rows="3">{{ $collaborator->note ?? old('note') }}</textarea>
    </div>
    <button type="submit" class="btn btn-cst btn-lg btn-block">Salvar</button>
    <a href="{{ route('collaborator.index') }}" class="btn btn btn-secondary btn-block shadow" role="button" aria-pressed="true">Voltar</a>
