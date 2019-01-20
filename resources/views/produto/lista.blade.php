@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard {!! auth()->user()->isAdmin == 1 ? 'Administrador' : 'Vendedor' !!}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div>
                        <a href="/home" class="btn btn-primary">Voltar</a>
                        @if (auth()->user()->isAdmin == 1)
                    <a href="{{ url('produtos/cadastrar') }}" class="btn btn-success">Adicionar Produto</a></div>         
                        @endif
                        
                   <table class="table table-bordered">
                       <thead>
                           <th>Código</th>
                           <th>Nome</th>
                           <th>Valor</th>
                       </thead>
                       <tbody>
                           @if (count($aProdutos) > 0)
                                @foreach ($aProdutos as $oProduto)
                                    <tr>
                                            <td>{!! $oProduto->id !!}</td>
                                            <td>{!! $oProduto->prod_desc !!}</td>
                                            <td>{!! $oProduto->prod_valo !!}</td>
                                    </tr>
                                @endforeach
                           @else
                                <tr>
                                    <td colspan="3" align="center">Nenhum produto cadastrado.</td>
                                </tr>
                           @endif
                           
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
