@include('admin.includes.alerts')

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{ $plan->name ?? old('name') }}" class="form-control" required>
    </div>
    <div class="form-group col-md-6">
        <label for="price">Preço</label>
        <input type="text" name="price" id="price" value="{{ $plan->price ?? old('price') }}" class="form-control" required>
    </div>
</div>

<div class="form-group">
    <label for="description">Descrição</label>
    <textarea name="description" id="description" class="form-control">{{ $plan->description ?? old('description') }}</textarea>
</div>

<button type="submit" class="btn btn-success">
    Salvar
</button>
