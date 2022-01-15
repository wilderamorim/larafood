@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" value="{{ $permission->name ?? old('name') }}" class="form-control" required>
</div>

<div class="form-group">
    <label for="description">Descrição</label>
    <textarea name="description" id="description" class="form-control">{{ $permission->description ?? old('description') }}</textarea>
</div>

<button type="submit" class="btn btn-success">
    Salvar
</button>