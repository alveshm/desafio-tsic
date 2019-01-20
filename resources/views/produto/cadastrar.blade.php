@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Dashboard {!! auth()->user()->isAdmin == 1 ? 'Administrador' : 'Vendedor' !!}</div>
                <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif   
                <form method="post" action="salvar">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="prod_desc">Descrição</label>
                            <input type="text" class="form-control" id="prod_desc" name="prod_desc" aria-describedby="desc" placeholder="Digite a descrição do Produto">
                        </div>
                        <div class="form-group">
                            <label for="prod_valo">Valor</label>
                            <input type="text" class="form-control" id="prod_valo" name="prod_valo" placeholder="Digite o valor do Produto">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
