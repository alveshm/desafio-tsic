@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard {{ auth()->user()->isAdmin == 1 ? 'Administrador' : 'Vendedor' }}</div>

                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="boxes">
                        <a href="/produtos">Produtos</a>
                        <a href="/vendas">Vendas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
