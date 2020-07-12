@include('includes.alerts')
@csrf
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="description">Descrição</label>
        <input name="description" type="text" class="form-control shadow-sm" id="description" value="{{ old('description') }}" required>
        <div class="invalid-feedback">
            A descrição do Tipo de Telefone é obrigatória!
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary btn-block">Salvar</button>
    </div>
</div>