@include('admin.includes.alerts')

<div class="row">
    <div class="col-lg-9 mb-4 mb-lg-0">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ $product->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="text" name="price" id="price" value="{{ $product->price ?? old('price') }}" class="form-control @error('price') is-invalid @enderror" required>
            @if($errors->has('price'))
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ $product->description ?? old('description') }}</textarea>
            @if($errors->has('description'))
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        <figure>
            <img src="{{ !empty($product->image) ? asset("/storage/{$product->image}") : '//placehold.it/360x360' }}" alt="..." class="img-fluid img-thumbnail">
        </figure>

        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
            @if($errors->has('image'))
                <div class="invalid-feedback">
                    {{ $errors->first('image') }}
                </div>
            @endif
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success">
    Salvar
</button>
