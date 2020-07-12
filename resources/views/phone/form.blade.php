@include('includes.alerts')
@csrf
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="description">Descrição</label>
        <input name="description" type="text" class="form-control shadow-sm" id="description" value="{{ $office->description ?? old('description') }}" required>
        <div class="invalid-feedback">
            A descrição do cargo é obrigatória!
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="access_id">Nível de acesso</label>
        <select name="access_id" class="custom-select" id="access_id" placeholder="Selecione o nivel de acesso:" required>
            @foreach ($access as $acces)
                @if (isset($office->access) && $office->access === $acces->id)
                <option value="{{ $acces->id }}" selected>{{ $acces->access }}</option>
                @endif
                <option value="{{ $acces->id }}">{{ $acces->access }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            O nível de acesso é obrigatório!
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary btn-block">Salvar</button>
    </div>
</div>