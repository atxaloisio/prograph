@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Carrocel de Imagens</a>                    
                    </h4>
                    <!-- Display Validation Errors -->
                        @include('common.errors')
                        <!-- Display Messages -->
                        @include('common.messages')
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        

                        <!-- New Task Form -->
                        <form action="/admin/salvarcarrocel" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="produto-name" class="col-sm-3 control-label">Produto</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nome" id="produto-nome" class="form-control" value="">
                                </div>                                                        
                            </div>
                            <div class="form-group">
                                <label for="produto-name" class="col-sm-3 control-label">Descrição</label>
                                <div class="col-sm-6">
                                    <input type="text" name="descricao" id="produto-descricao" class="form-control" value="">
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
                    <div class="panel-group" id="accordion">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Imagen1</a>
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Imagen2</a>
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Imagen3</a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-body panel-collapse collapse">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="/w3images/lights.jpg" target="_blank">
                                            <img src="/w3images/lights.jpg" alt="Lights" style="width:100%">
                                            <div class="caption">
                                                <p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="/w3images/nature.jpg" target="_blank">
                                            <img src="/w3images/nature.jpg" alt="Nature" style="width:100%">
                                            <div class="caption">
                                                <p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="/w3images/fjords.jpg" target="_blank">
                                            <img src="/w3images/fjords.jpg" alt="Fjords" style="width:100%">
                                            <div class="caption">
                                                <p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="collapse3" class="panel-body panel-collapse collapse">Panel Body 3</div>
                        <div id="collapse4" class="panel-body panel-collapse collapse">Panel Body 4</div>
                    </div>

                    <div class="panel-footer">Panel Footer</div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Produtos em destaque</div>                
                <div class="panel-body">

                </div>
                <div class="panel-footer">Panel Footer</div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Produtos Recomendados</div>                
                <div class="panel-body">

                </div>
                <div class="panel-footer">Panel Footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
