@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse1">Incluir imagens de produto</a>                    
                </h4>                
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <form action="/admin/uploadimagem" method="post" class="form-horizontal" enctype="multipart/form-data">                
                        {{ csrf_field() }}
                        <div><input type="hidden" name="produtoid" id="txt_id_produto" value="{{isset($produto)? $produto->id : ''}}"></div>
                        <div class="form-group">
                            <label for="produto-name" class="col-sm-3 control-label">Produto</label>
                            <div class="col-sm-8">                                        
                                <input type="text" name="descricao_produto" id="txt_descricao_produto" class="form-control" value="{{isset($produto)? $produto->id.' - '.$produto->nome : ''}}" readonly>
                            </div>                        
                        </div>
                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="produto-name" class="col-sm-3 control-label">Imagem</label>
                            <div class="col-sm-8">
    <!--                            <span class="btn btn-default btn-file">
                                    <input type="file" name="campoimagem" id="imagem">                        
                                </span>                            -->
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                            Escolher&hellip; <input type="file" style="display: none;" name="campoimagem" id="imagem" accept="image/*">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>                                                        
                        </div>
                        <div class="form-group">
                            <label for="descricao_produto" class="col-sm-3 control-label">Descrição</label>
                            <div class="col-sm-8">                                        
                                <input type="text" name="descricao_produto" id="txt_descricao_produto" class="form-control" value="{{isset($produto)? $produto->id.' - '.$produto->nome : ''}}">
                            </div>                        
                        </div>

                        <div class="form-group">                            
                            <div class="col-sm-offset-3 checkbox col-sm-8">
                                <label for="chkdefault" class="col-sm-8 control-label"><input type="checkbox" name="chkdefault" id="chkdefault">Imagem Principal</label>

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
            </div>            
        </div>
        <div class="panel panel-default" id="testediv">

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
                            @foreach ($produto_imagem as $imagem)
                            <tr>
                                <td class="table-text">
                                    <div>
                                        <div class="wb_element" style="height: 180px; width: 33%;position: relative; float: left;">
                                            <div>
                                                <center>
                                                    <a href="loja/">
                                                        <img alt="destaque2" src="{{asset('/images/'.$imagem->nome)}}" height="120px" width="120px">
                                                    </a>
                                                </center>
                                            </div>
                                            <div style="border-top: 10px; padding-top: 10px;">
                                                <center>
                                                    <form action="/admin/produto/produtoimagem/{{ $imagem->id }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}

                                                        <button type="submit" id="delete-produto-{{ $imagem->id }}" class="btn btn-danger">
                                                            <i class="fa fa-btn fa-trash"></i>Delete
                                                        </button>
                                                    </form>
                                                </center>
                                            </div>
                                        </div>                                            
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>{{$imagem->descricao}}</div>                                        
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @else
            <div class="panel panel-default">
                <div class="panel-heading">
                    Produto ainda não possui imagem cadastrada.
                </div>
            </div>                
            @endif

        </div>
    </div>
</div>
@endsection