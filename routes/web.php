<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', 'Front@index');
Route::get('/produtos', 'Front@produtos');
Route::get('/produtos/detalhe/{id}', 'Front@produto_detalhe');
Route::post('/admin/salvarcarrocel', 'AdminController@salvarcarrocel');
Route::get('/produtos/categorias/{nome}', 'Front@produto_categorias');
Route::get('/produtos/marcas/{nome}/{categoria?}', 'Front@produto_marcas');
Route::get('/blog', 'Front@blog');
Route::get('/blog/{id}', 'Front@blog_post');
Route::get('/contact-us', 'Front@contact_us');
Route::get('auth/login', 'Front@login');
Route::post('auth/login', 'Front@authenticate');
Route::post('/register', 'Front@register');
Route::get('auth/logout', 'Front@logout');
Route::get('/cart', 'Front@cart');
Route::post('/cart', 'Front@cart');
Route::delete('/cart-remove-item', 'Front@cart_remove_item');
Route::get('/clear-cart', 'Front@clear_cart');
Route::get('/checkout', ['middleware' => 'auth', 'uses' => 'Front@checkout']);
Route::get('/search/{query}', 'Front@search');

Route::get('/lerapi/{id?}', 'Front@lerapi');

//Administrativo
Route::get('/admin', ['middleware' => 'auth', 'uses' => 'AdminController@index']);
//Administrativo - Produtos
route::get('/admin/produtos', 'ProdutoController@index');
Route::post('/admin/produto', 'ProdutoController@store');
Route::get('/admin/produto/{produto}', 'ProdutoController@edit');
Route::post('/admin/produto/{produto}', 'ProdutoController@update');
Route::delete('/admin/produto/{produto}', 'ProdutoController@destroy');
//Ad ministrativo - Produto Imagem
Route::get('/admin/produto/upload', 'ProdutoController@upload');
Route::get('/admin/produto/uploadimagem/{produto}', 'ProdutoController@uploadimagem');
Route::get('/admin/produto/upload/{produto}', 'ProdutoController@getproduto');
Route::get('/admin/produto/produtoimagem', 'ProdutoController@gettoken');
Route::get('/admin/produto/produtoimagem/{produto}', 'ProdutoController@getprodutoimagem');
Route::delete('/admin/produto/produtoimagem/{produto}', 'ProdutoController@destroyprodutoimagem');
Route::post('/admin/produto/upload', 'ProdutoController@saveUpload');

Route::get('/admin/categorias', 'CategoriaController@index');
Route::post('/admin/categoria', 'CategoriaController@store');
Route::get('/admin/categoria/{categoria}', 'CategoriaController@edit');
Route::post('/admin/categoria/{categoria}', 'CategoriaController@update');
Route::delete('/admin/categoria/{categoria}', 'CategoriaController@destroy');




Route::get('/api/v1/produtos/{id?}', ['middleware' => 'auth.basic', function($id = null) {
        if ($id == null) {
            $produtos = App\Product::all(array('id', 'name', 'price'));
        } else {
            $produtos = App\Product::find($id, array('id', 'name', 'price'));
        }
        return Response::json(array(
                    'error' => false,
                    'produtos' => $produtos,
                    'status_code' => 200
        ));
    }]);

Route::get('/api/v1/categorias/{id?}', ['middleware' => 'auth.basic', function($id = null) {
        if ($id == null) {
            $categorias = App\Category::all(array('id', 'name'));
        } else {
            $categorias = App\Category::find($id, array('id', 'name'));
        }
        return Response::json(array(
                    'error' => false,
                    'user' => $categorias,
                    'status_code' => 200
        ));
    }]);

Route::get('/insert', function() {
    App\Category::create(array('name' => 'Music'));

    return 'categoria added';
});

Route::get('/read', function() {
    $categoria = new App\Category();

    $data = $categoria->all(array('name', 'id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '<br>';
    }
});

Route::get('/update', function() {
    $categoria = App\Category::find(6);
    $categoria->name = 'HEAVY METAL';
    $categoria->save();

    $data = $categoria->all(array('name', 'id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '<br>';
    }
});

Route::get('/delete', function() {
    $categoria = App\Category::find(5);
    $categoria->delete();

    $data = $categoria->all(array('name', 'id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '<br>';
    }
});



Route::get('/raw', function () {
    $sql = "INSERT INTO categorias (name) VALUES ('POMBE')";

    DB::statement($sql);
    $results = DB::select(DB::raw("SELECT * FROM categorias"));

    print_r($results);
}
);

Route::get('blade', function () {
    $drinks = array('Vodka', 'Gin', 'Brandy');
    return view('page', array('name' => 'The Raven', 'day' => 'Friday', 'drinks' => $drinks));
});

Auth::routes();
Route::get('/home', 'Front@index');

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/','Front@index');
//Route::get('blade', function () {
//    return view('page',array('name' => 'The Raven','day' => 'Friday'));
//});

/*
Route::get('/','Front@index');

Route::get('blade', function () {
    $drinks = array('Vodka','Gin','Brandy');
    return view('page',array('name' => 'The Raven','day' => 'Friday','drinks' => $drinks));
});
Route::get('/produtos','Front@produtos');
Route::get('/produtos/detalhe/{id}','Front@produto_detalhe');
Route::get('/produtos/categorias','Front@produto_categorias');
Route::get('/produtos/marcas','Front@produto_marcas');
Route::get('/blog','Front@blog');
Route::get('/blog/post/{id}','Front@blog_post');
Route::get('/contact-us','Front@contact_us');
Route::get('/login','Front@login');
Route::get('/logout','Front@logout');
Route::get('/cart','Front@cart');
Route::get('/checkout','Front@checkout');
Route::get('/search/{query}','Front@search');
Route::post('/cart', 'Front@cart');

Auth::routes();
Route::get('/home','Front@index');
//Route::get('/home', 'HomeController@index')->name('home');
*/


