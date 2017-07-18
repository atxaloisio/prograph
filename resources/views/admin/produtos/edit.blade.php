@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alterar Produto
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    @include('common.messages')
                    <!-- New Task Form -->
                    <form action="/admin/produto/{{ $produto->id }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                                                
                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="produto-name" class="col-sm-3 control-label">Produto</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="produto-nome" class="form-control" value="{{$produto->nome}}">
                            </div>                                                        
                        </div>
                        <div class="form-group">
                            <label for="produto-name" class="col-sm-3 control-label">Descrição</label>
                            <div class="col-sm-6">
                                <input type="text" name="description" id="produto-descricao" class="form-control" value="{{$produto->descricao}}">
                            </div>
                        </div>    

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Alterar Produto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>
@endsection
