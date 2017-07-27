@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Alterar Categoria
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                @include('common.messages')
                <!-- New Task Form -->
                <form action="/admin/categoria/{{ $categoria->id }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Categoria</label>
                        <div class="col-sm-8">
                            <input type="text" name="nome" id="nome" class="form-control" value="{{$categoria->nome}}" autofocus>
                        </div>                                                                                                                              
                    </div>                                        
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6 text-center">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-save"></i> Alterar Categoria
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>            
    </div>
    <div class="col-sm-offset-2 col-sm-8">    
        <!-- Current Tasks -->
        @if (count($categorias) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Lista de Categorias
            </div>

            <div class="panel-body">
                <div class="table-responsive">  
                    <table class="table table-striped produto-table table-hover">
                        <thead>
                        <th>Categoria</th>                        
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                            <tr>
                                <td class="table-text" style="width: 600px"><div>{{ $categoria->nome }}</div></td>                                                                
                                <td>
                                    <form action="/admin/categoria/{{ $categoria->id }}" method="GET">
                                        {{ csrf_field() }}
                                        {{ method_field('EDIT') }}

                                        <button type="submit" id="edit-produto-{{ $categoria->id }}" class="btn btn-warning">
                                            <i class="fa fa-btn fa-edit"></i> Alterar
                                        </button>
                                    </form>
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    <form action="/admin/categoria/{{ $categoria->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-produto-{{ $categoria->id }}" class="btn btn-danger">
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
