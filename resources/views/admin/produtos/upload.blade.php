@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Incluir imagens de produto
            </div>
            <div class="panel-body">                
                <div class="col-sm-2">
                    <label for="produto-name" class="col-sm-12 control-label">Produto</label>
                </div>
                <div class="col-sm-4">                                        
                    <div class="input-group">                        
                        <input type="text" class="form-control" placeholder="" id="txt_codigo_produto" value="{{isset($produto)? $produto->nome : ''}}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="btn_Buscar">
                                <i class="fa fa-btn fa-search"></i>
                            </button>
                        </span>
                    </div><!-- /input-group -->   
                </div>
                <div class="col-sm-6">
                    <input type="text" name="descricao_produto" id="txt_descricao_produto" class="form-control" value="{{isset($produto)? $produto->nome : ''}}">                    
                </div>
            </div>
            <div class="panel-default">
                <form action="/upload" method="post" class="form-horizontal" enctype="multipart/form-data">                
                    {{ csrf_field() }}
                    <div><input type="hidden" name="produtoid" id="txt_id_produto" value="{{isset($produto)? $produto->id : ''}}"></div>

                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="produto-name" class="col-sm-3 control-label">Imagem</label>
                        <div class="col-sm-9">
                            <input type="file" name="campoimagem" id="imagem">                        
                        </div>                                                        
                    </div>
                    
                    <div class="form-group">
                        <label for="produto-name" class="col-sm-3 control-label">Descrição</label>
                        <div class="col-sm-8">
                            <input type="text" name="descricao" id="descricao" class="form-control">                        
                        </div>                                                        
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-cloud-upload"></i>Salvar Imagem
                            </button>
                        </div>
                    </div>
                </form>            
            </div>
            <div id="testediv" class="panel-body">
                <!-- Current Tasks -->
                @if (isset($produto_imagem))
                @if (count($produto_imagem) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Imagens do Produto
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped produto-table">
                            <thead>
                            <th>Produto</th>                            
                            </thead>
                            <tbody>
                                @foreach ($produto_imagem as $produto)
                                <tr>
                                    <td class="table-text">
                                        <div>
                                            <div class="wb_element" style="height: 180px; width: 33%;position: relative; float: left;">
                                                <div>
                                                    <center>
                                                        <a href="loja/">
                                                            <img alt="destaque2" src="{{asset('/imagens/'.$produto->caminho)}}" height="120px" width="120px">
                                                        </a>
                                                    </center>
                                                </div>
                                                <div style="border-top: 10px; padding-top: 10px;">
                                                    <center>
                                                        <form action="/produtoimagem/{{ $produto->id }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}

                                                            <button type="submit" id="delete-produto-{{ $produto->id }}" class="btn btn-danger">
                                                                <i class="fa fa-btn fa-trash"></i>Delete
                                                            </button>
                                                        </form>
                                                    </center>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$produto->descricao}}</div>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>        
    </div>
</div>
@endsection