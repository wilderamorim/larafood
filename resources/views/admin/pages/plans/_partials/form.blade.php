@include('admin.includes.alerts')

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{ $plan->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
        @if($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="price">Preço</label>
        <input type="text" name="price" id="price" value="{{ $plan->price ?? old('price') }}" class="form-control @error('price') is-invalid @enderror" required>
        @if($errors->has('price'))
            <div class="invalid-feedback">
                {{ $errors->first('price') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="description">Descrição</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ $plan->description ?? old('description') }}</textarea>
    @if($errors->has('description'))
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    @endif
</div>

<button type="submit" class="btn btn-success">
    Salvar
</button>
