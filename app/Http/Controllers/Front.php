<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Categoria;
use App\Produto;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Cart;
use GuzzleHttp\Client;

class Front extends Controller {

    var $marcas;
    var $categorias;
    var $produtos;
    var $titulo;
    var $descricao;

    public function __construct() {
        $this->marcas = Marca::all(array('nome'));
        $this->categorias = Categoria::all(array('nome'));
        //$this->produtos = Produto::all(array('id', 'nome', 'price'))->paginate(3);
        $this->produtos = Produto::paginate(6);
    }

    public function index() {
        return view('loja.home', array('titulo' => 'Bem Vindo', 'descricao' => '', 'page' => 'home', 'marcas' => $this->marcas, 'categorias' => $this->categorias, 'produtos' => $this->produtos, 'categoria' =>''));
    }

    public function produtos() {
        return view('loja.produtos', array('titulo' => 'Lista de Produtos', 'descricao' => '', 'page' => 'produtos', 'marcas' => $this->marcas, 'categorias' => $this->categorias, 'produtos' => $this->produtos, 'categoria' =>''));
    }

    public function produto_detalhe($id) {
        $product = Produto::find($id);
        $categoria = Categoria::find($product->categoria_id);
        return view('loja.produto_detalhe', array('product' => $product, 'titulo' => $product->nome, 'descricao' => '', 'page' => 'produtos', 'marcas' => $this->marcas, 'categorias' => $this->categorias, 'produto' => $product, 'categoria' => $categoria));
    }

    public function produto_categorias($nome) {
        $categoria = Categoria::where('nome', '=', $nome)->first();
        $prds = Produto::where('categoria_id', '=', $categoria->id)->paginate(6);
        return view('loja.produtos', array('titulo' => 'Welcome', 'descricao' => '', 'page' => 'produtos', 'marcas' => $this->marcas, 'categorias' => $this->categorias, 'produtos' => $prds, 'categoria' => $categoria->nome));
    }

    public function produto_marcas($nome, $categoria = null) {
        return view('loja.produtos', array('titulo' => 'Bem Vindo', 'descricao' => '', 'page' => 'produtos', 'marcas' => $this->marcas, 'categorias' => $this->categorias, 'produtos' => $this->produtos, 'categoria' =>''));
    }

    public function blog() {
        $posts = \App\Post::where('id', '>', 0)->paginate(3);
        $posts->setPath('blog');

        $data['posts'] = $posts;

        return view('blog.blog', array('data' => $data, 'titulo' => 'Latest Blog Posts', 'descricao' => '', 'page' => 'blog', 'marcas' => $this->marcas, 'categorias' => $this->categorias, 'produtos' => $this->produtos));
    }

    public function blog_post($url) {
        $post = \App\Post::where('url', '=', $url)->get();

        $post_id = $post[0]['id'];
        
        $tags = \App\BlogPostTag::postTags($post_id);

        $previous_url = \App\Post::prevBlogPostUrl($post_id);
        $next_url = \App\Post::nextBlogPostUrl($post_id);

        $data['previous_url'] = $previous_url;
        $data['next_url'] = $next_url;
        $data['tags'] = $tags;
        $data['post'] = $post[0];

        return view('blog.blog_post', array('data' => $data, 'titulo' => $post[0]['titulo'], 'descricao' => $post[0]['descricao'], 'page' => 'blog', 'marcas' => $this->marcas, 'categorias' => $this->categorias, 'produtos' => $this->produtos));
    }

    public function contact_us() {
        return view('contact_us', array('titulo' => 'Welcome', 'descricao' => '', 'page' => 'contact_us'));
    }

    public function register() {
        if (Request::isMethod('post')) {
            User::create(['name' => Request::get('name'), 'email' => Request::get('email'), 'password' => bcrypt(Request::get('password')),]);
        }

        return Redirect::away('login');
    }

    public function authenticate() {
        if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')])) {
            return redirect()->intended('checkout');
        } else {
            return view('login', array('titulo' => 'Welcome', 'descricao' => '', 'page' => 'home'));
        }
    }

    public function login() {
        return view('login', array('titulo' => 'Welcome', 'descricao' => '', 'page' => 'home'));
    }

    public function logout() {
        Auth::logout();

        return Redirect::away('login');
    }

    public function cart() {
        //update/ add new item to cart
        if (Request::isMethod('post')) {
            $product_id = Request::get('product_id');
            $product = Produto::find($product_id);
            Cart::add(['id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price]);
        }

        //increment the quantity
        if (Request::get('product_id') && (Request::get('increment')) == 1) {
            //$rowId = Cart::search(array('id' => Request::get('product_id')));
            $rowId = Cart::search(function($key, $value) {
                        return $key->id == Request::get('product_id');
                    });
            if (count($rowId) > 0) {
                $item = $rowId->first();

                Cart::update($rowId->first()->rowId, $item->qty + 1);
            }
        }

        //decrease the quantity
        if (Request::get('product_id') && (Request::get('decrease')) == 1) {
            //$rowId = Cart::search(['id' => Request::get('product_id')]);
            $rowId = Cart::search(function($key, $value) {
                        return $key->id == Request::get('product_id');
                    });
            if (count($rowId) > 0) {
                $item = $rowId->first();

                Cart::update($rowId->first()->rowId, $item->qty - 1);
            }
        }

        $cart = Cart::content();

        return view('loja.cart', array('cart' => $cart, 'titulo' => 'Welcome', 'descricao' => '', 'page' => 'home'));
    }

    public function cart_remove_item() {
        //$rowId = Cart::search(array('id' => Request::get('product_id')));
        $rowId = Cart::search(function($key, $value) {
                        return $key->id == Request::get('product_id');
                    });
        Cart::remove($rowId->first()->rowId);
        
        $cart = Cart::content();

        return view('loja.cart', array('cart' => $cart, 'titulo' => 'Welcome', 'descricao' => '', 'page' => 'home'));
    }

    public function clear_cart() {
        Cart::destroy();
        //return Redirect::away('loja.cart');
        $cart = Cart::content();
        return view('loja.cart', array('cart' => $cart, 'titulo' => 'Welcome', 'descricao' => '', 'page' => 'home'));
    }

    public function checkout() {
        return view('loja.checkout', array('titulo' => 'Welcome', 'descricao' => '', 'page' => 'home'));
    }

    public function search($query) {
        return view('loja.produtos', array('titulo' => 'Welcome', 'descricao' => '', 'page' => 'produtos'));
    }
    
    public function lerapi($id = null){
        $client = new Client(['base_uri' => 'http://prograph.localhost/api/v1/produtos/']);
        $res = $client->request('GET', $id, ['auth' => ['atxaloisio@hotmail.com','mestreat']]);
        
        $result= $res->getBody();
        return $result;
    }

}
