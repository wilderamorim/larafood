@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" value="{{ $planDetail->name ?? old('name') }}" class="form-control" required>
</div>

<button type="submit" class="btn btn-success">
    Salvar
</button>
