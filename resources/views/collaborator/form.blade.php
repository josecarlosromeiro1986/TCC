@include('includes.alerts')
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <input type="text" class="form-control shadow-sm" name="name" id="name" value="" required>
        </div>
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="email" class="form-control shadow-sm" name="email" id="email" required>
        </div>
        <div class="form-group col-md-3">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control shadow-sm cpf" name="cpf" id="cpf" required>
        </div>
        <div class="form-group col-md-3">
            <label for="rg">RG</label>
            <input type="text" class="form-control shadow-sm rg" name="rg" id="rg" required>
        </div>
        <div class="form-group col-md-3">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control shadow-sm phone" name="phone" id="phone" required>
        </div>
        <div class="form-group col-md-3">
            <label for="birth">Data de Nascimento</label>
            <input type="date" class="form-control shadow-sm" name="birth" id="birth" required>
        </div>
        <div class="form-group col-md-6">
            <label for="office_id">Cargo</label>
            <select name="office_id" id="office_id" class="form-control shadow-sm" placeholder="Selecione o cargo:"
                required>
                @foreach ($offices as $office)
                    @if (isset($office->access_id) && $office->access_id === $acces->id)
                        <option value="{{ $acces->id }}" selected>{{ $acces->access }}</option>
                    @else
                        <option value="{{ $office->id }}">{{ $office->description }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="start">Data de Inicio</label>
            <input type="date" class="form-control shadow-sm" name="start" id="start" required>
        </div>
        <div class="form-group col-md-3">
            <label for="cep">CEP
                <div id="loading" class=""></div>
            </label>
            <input class="form-control shadow-sm cep" name="cep" type="text" id="cep" value="" size="10" maxlength="9"
                onblur="pesquisacep(this.value);" /></label>
        </div>
        <div class="form-group col-md-6">
            <label for="address">Endereço</label>
            <input type="text" class="form-control shadow-sm" name="address" id="address" required>
        </div>
        <div class="form-group col-md-4">
            <label for="complement">Complemento</label>
            <input type="text" class="form-control shadow-sm" name="complement" id="complement" required>
        </div>
        <div class="form-group col-md-2">
            <label for="number">Número</label>
            <input type="number" class="form-control shadow-sm" name="number" id="number" required>
        </div>
        <div class="form-group col-md-6">
            <label for="neighborhood">Bairro</label>
            <input type="text" class="form-control shadow-sm" name="neighborhood" id="neighborhood" required>
        </div>
        <div class="form-group col-md-3">
            <label for="state">Estado</label>
            <input type="text" class="form-control shadow-sm" name="state" id="state" required>
        </div>
        <div class="form-group col-md-3">
            <label for="city">Cidade</label>
            <input type="text" class="form-control shadow-sm" name="city" id="city" required>
        </div>
        <div class="form-group col-md-6">
            <label for="user">Nome de usuário</label>
            <input type="text" class="form-control shadow-sm" name="user" id="user" required>
        </div>
        <div class="form-group col-md-6">
            <label for="password">Senha</label>
            <input type="text" class="form-control shadow-sm" name="password" id="password" required>
        </div>
    </div>
    <div class="form-group">
        <label for="note">Observações</label>
        <textarea class="form-control shadow-sm" name="note" id="note" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-cst btn-lg btn-block">Salvar</button>