@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" value="{{ $user->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
    @if($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" value="{{ $user->email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
    @if($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="password">Senha</label>
    <input type="password" name="password" id="password" value="" class="form-control @error('password') is-invalid @enderror">
    @if($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>

<button type="submit" class="btn btn-success">
    Salvar
</button>
