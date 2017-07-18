@extends('layouts.layout')

@section('content')       
<!--<section id="advertisement">
    <div class="container">
        <img src="{{asset('images/shop/advertisement.jpg')}}" alt="" />
    </div>
</section>-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    @include('shared.sidebar')
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    
                    @if($categoria != '')
                    <h2 class="title text-center">{{$categoria}}</h2>
                    @else
                    <h2 class="title text-center">Produtos</h2>
                    @endif                    
                    
                    @foreach ($produtos as $produto)
                    <form method="POST" action="{{url('cart')}}">
                        <input type="hidden" name="product_id" value="{{$produto->id}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('images/shop/product9.jpg')}}" alt="" />
                                        <h2>R${{$produto->preco}}</h2>
                                        <p>{{$produto->nome}}</p>                                    
                                        <button type="submit" class="btn btn-fefault add-to-cart"><i class="fa fa-shopping-cart"></i>Comprar</button>                                    
                                        <a href='{{url("produtos/detalhe/$produto->id")}}' class="btn btn-default add-to-cart"><i class="fa fa-info"></i>Ver Detalhe</a>
    <!--                                    <a href="{{url('cart')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Comprar</a>
                                    <a href='{{url("products/details/$produto->id")}}' class="btn btn-default add-to-cart"><i class="fa fa-info"></i>Ver Detalhes</a>-->
                                    </div>
                                    <!--                                <div class="product-overlay">
                                                                        <div class="overlay-content">
                                                                            <h2>${{$produto->price}}</h2>
                                                                            <p>${{$produto->name}}</p>
                                                                            <form method="POST" action="{{url('cart')}}">
                                                                                <input type="hidden" name="product_id" value="{{$produto->id}}">
                                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                <button type="submit" class="btn btn-fefault add-to-cart">
                                                                                    <i class="fa fa-shopping-cart"></i>
                                                                                    Add to cart
                                                                                </button>
                                                                            </form>
                                                                            <a href='{{url("products/details/$produto->id")}}' class="btn btn-default add-to-cart"><i class="fa fa-info"></i>View Details</a>
                                                                        </div>
                                                                    </div>-->
                                </div>
                                <!--                            <div class="choose">
                                                                <ul class="nav nav-pills nav-justified">
                                                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                                </ul>
                                                            </div>-->
                            </div>
                        </div>
                    </form>
                    @endforeach
                    {{ $produtos->links() }}
                    <!--                    <ul class="pagination">
                                            <li class="active"><a href="">1</a></li>
                                            <li><a href="">2</a></li>
                                            <li><a href="">3</a></li>
                                            <li><a href="">&raquo;</a></li>
                                        </ul>-->
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection