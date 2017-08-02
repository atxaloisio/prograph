@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Alterar Marca
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                @include('common.messages')
                <!-- New Task Form -->
                <form action="/admin/marca/{{ $marca->id }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Marca</label>
                        <div class="col-sm-8">
                            <input type="text" name="nome" id="nome" class="form-control" value="{{$marca->nome}}" autofocus>
                        </div>                                                                                                                              
                    </div>                                        
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6 text-center">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-save"></i> Alterar Marca
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>            
    </div>
    <div class="col-sm-offset-2 col-sm-8">    
        <!-- Current Tasks -->
        @if (count($marcas) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Lista de Marcas
            </div>

            <div class="panel-body">
                <div class="table-responsive">  
                    <table class="table table-striped produto-table table-hover">
                        <thead>
                        <th>Marca</th>                        
                        </thead>
                        <tbody>
                            @foreach ($marcas as $marca)
                            <tr>
                                <td class="table-text" style="width: 600px"><div>{{ $marca->nome }}</div></td>                                                                
                                <td>
                                    <form action="/admin/marca/{{ $marca->id }}" method="GET">
                                        {{ csrf_field() }}
                                        {{ method_field('EDIT') }}

                                        <button type="submit" id="edit-produto-{{ $marca->id }}" class="btn btn-warning">
                                            <i class="fa fa-btn fa-edit"></i> Alterar
                                        </button>
                                    </form>
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    <form action="/admin/marca/{{ $marca->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-produto-{{ $marca->id }}" class="btn btn-danger">
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
