<h2>Categorias</h2>
<div class="panel-group categoria-produtos" id="accordian"><!--categoria-produtosr-->
    <div class="panel panel-default">
        @foreach ($categorias as $categoria)
        <div class="panel-heading">
            <h4 class="panel-title"><a href='{{url("produtos/categorias/$categoria->nome")}}'>{{$categoria->nome}}</a></h4>
        </div>
        @endforeach
    </div>
</div><!--/categoria-produtos-->
<br>
<div class="marcas_produtos"><!--marcas_produtos-->
    <h2>Marcas</h2>
    <div class="marcas-name">
        <ul class="nav nav-pills nav-stacked">
            @foreach ($marcas as $marca)
            <li><a href='{{url("produtos/marcas/$marca->nome")}}'> <span class="pull-right">(50)</span>{{$marca->nome}}</a></li>
            @endforeach
        </ul>
    </div>
</div><!--/marcas_produtos-->

<div class="shipping text-center"><!--shipping-->
    <img src="{{asset('images/home/shipping.jpg')}}" alt="" />
</div><!--/shipping-->