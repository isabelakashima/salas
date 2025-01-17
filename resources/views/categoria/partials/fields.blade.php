<div class="card">
    <div class="card-header">
        <b>{{ $categoria->nome }}</b>
        <div>
            <form action="/categorias/{{  $categoria->id  }}" method="POST">
                <a class="btn btn-success" href="/categorias/{{  $categoria->id  }}/edit" role="button" data-bs-toggle="tooltip" title="Editar">
                    <i class="fa fa-pen"></i>
                </a>
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit" name="tipo" value="one" data-bs-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza?');">
                    <i class="fa fa-trash" ></i>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
    @include('categoria.partials.addForm')
    <br>
    @include('categoria.partials.pesIndex')
    </div>
</div>
<br>