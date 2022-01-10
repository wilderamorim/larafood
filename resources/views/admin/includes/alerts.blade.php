@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">
            Ocorreram os seguintes erros:
        </h4>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
