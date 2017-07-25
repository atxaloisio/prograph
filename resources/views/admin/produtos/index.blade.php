@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Novo Produto
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                @include('common.messages')
                <!-- New Task Form -->
                <form action="/admin/produto" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="produto-name" class="col-sm-3 control-label">Produto</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="produto-nome" class="form-control" value="">
                        </div>                                                        
                    </div>
                    <div class="form-group">
                        <label for="produto-name" class="col-sm-3 control-label">Descrição</label>
                        <div class="col-sm-6">
                            <input type="text" name="description" id="produto-descricao" class="form-control" value="">
                        </div>
                    </div>    

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Adicionar Produto
                            </button>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
    </div>
    <div class="col-sm-12">    
        <!-- Current Tasks -->
        @if (count($produtos) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Lista de Produtos
            </div>

            <div class="panel-body">
                <div class="table-responsive">  
                    <table class="table table-striped produto-table table-hover">
                        <thead>
                        <th>Produto</th>
                        <th>Descricao</th>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                            <tr>
                                <td class="table-text" style="width: 300px"><div>{{ $produto->nome }}</div></td>
                                <td class="table-text" style="width: 600px"><div>{{ $produto->descricao }}</div></td>
                                <td>
                                    <form action="/admin/produto/uploadimagem/{{ $produto->id }}" method="GET">
                                        {{ csrf_field() }}
                                        {{ method_field('EDIT') }}

                                        <button type="submit" id="edit-produto-{{ $produto->id }}" class="btn btn-primary">
                                            <i class="fa fa-btn fa-picture-o"></i> Imagem
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/admin/produto/{{ $produto->id }}" method="GET">
                                        {{ csrf_field() }}
                                        {{ method_field('EDIT') }}

                                        <button type="submit" id="edit-produto-{{ $produto->id }}" class="btn btn-warning">
                                            <i class="fa fa-btn fa-edit"></i> Alterar
                                        </button>
                                    </form>
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    <form action="/admin/produto/{{ $produto->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-produto-{{ $produto->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash-o"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
