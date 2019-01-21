@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard {{ auth()->user()->isAdmin == 1 ? 'Administrador' : 'Vendedor' }}</div>

                <div class="codigo">
                <label>Venda atual: {{ $codigo }}</label>
                </div>
                @if (isset($error))
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endif
                <div class="principal">
                        <div class="botoes-finalizar col-md-12">
                                <a href="{{ url('home') }}" class="btn btn-secondary">Cancelar</a>
                                <form method="POST" action="finalizarVenda">
                                    {{ csrf_field() }}
                                    <input type="hidden"  name="codiDocuAtualizar" value="{{ $codigo }}">
                                    <input type="submit" class="btn btn-success" name="confirmar" value="confirmar">
                                </form>
                            </div>
                    <div class="col-md-8">
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <th>Cod.</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                </thead>
                                <tbody>
                                    
                                    @if (isset($aProdutos))
                                        @foreach ($aProdutos as $oProduto)
                                        <tr>
                                            <td>{{ $oProduto[0]->id }}</td>
                                            <td>{{ $oProduto[0]->prod_desc }}</td>
                                            <td>{{ $oProduto[0]->prod_valo }}</td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">Nenhum produto na lista de compras.</td>
                                        </tr>
                                    @endif
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form method="POST" action="{{ url('vendas/busca') }}">
                            {{ csrf_field() }}
                            <div class="form-group">        
                                <label for="busca">Produto:</label>
                                <input type="hidden" name="codiDocu" value="{{ $codigo }}">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="busca" id="busca">
                                <input type="submit"  class="btn btn-primary" value="OK">
                            </div>
                        </form>
                    </div>
                    
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection
