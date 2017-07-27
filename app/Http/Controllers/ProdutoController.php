<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Produto;
use App\ProdutoImagem;
use App\Categoria;
use App\Marca;
use Illuminate\Http\JsonResponse;
use App\Utils;

class ProdutoController extends Controller {

    /**
     * The produto repository instance.
     *
     * @var TaskRepository
     */
    protected $produtos;
    protected $categorias;
    protected $marcas;

    /**
     * Create a new controller instance.
     *
     * @param  ProdutoRepository  $produtos
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');

        $this->produtos = Produto::all();
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
    }

    /**
     * Display a list of all of the user's produto.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index() {
        return view('admin.produtos.index', [
            'produtos' => $this->produtos,
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
        ]);
    }

    public function edit(Produto $produto) {
        $prd = Produto::find($produto->id);
        //realiza o parse para o formato de moeda.
        $prd->preco = Utils::dbToMoeda($prd->preco);
        return view('admin.produtos.edit', [
            'produto' => $prd,
            'produtos' => $this->produtos,
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
        ]);
    }

    public function update(Request $request, Produto $produto) {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'descricao' => 'required|max:500',
        ]);
        
        $categ = Categoria::where('nome', '=', $request->categoria)->first();
        $mrc = Marca::where('nome', '=', $request->marca)->first();

        $produto_update = Produto::find($produto->id);
        $produto_update->nome = $request->nome;
        $produto_update->titulo = $request->nome;
        $produto_update->preco = Utils::moedaToDB($request->preco);
        $produto_update->descricao = $request->descricao;
        $produto_update->categoria_id = $categ->id;
        $produto_update->marca_id = $mrc->id;

        $produto_update->save();

        //Session::flash('message', 'Successfully updated produto!');

        $request->session()->flash('status', 'Produto alterado com sucesso!');
        
        return redirect('/admin/produtos');
//        $this->produtos = Produto::all();
//        return view('admin.produtos.index', [
//            'produtos' => $this->produtos,
//            'categorias' => $this->categorias,
//            'marcas' => $this->marcas,
//        ]);
    }

    /**
     * Create a new produto.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'descricao' => 'required|max:500',
        ]);
        
        $categ = Categoria::where('nome', '=', $request->categoria)->first();
        $mrc = Marca::where('nome', '=', $request->marca)->first();
                                
        $produto = new Produto([
            'nome' => $request->nome,
            'titulo' => $request->nome,
            'preco' => Utils::moedaToDB($request->preco) ,
            'descricao' => $request->descricao,
            'categoria_id' => $categ->id,
            'marca_id' => $mrc->id,
        ]);

        $produto->save();
        
        $request->session()->flash('status', 'Produto cadastrado com sucesso!');

        return redirect('/admin/produtos');
    }

    /**
     * Destroy the given produto.
     *
     * @param  Request  $request
     * @param  Produto  $produto
     * @return Response
     */
    public function destroy(Request $request, Produto $produto) {
        //$this->authorize('destroy', $produto);
        Produto::destroy($produto->id);
        $request->session()->flash('status', 'produto excluído com sucesso!');
        
        return redirect('/admin/produtos');
    }

    public function upload() {
        return view('admin.produtos.upload');
    }

    public function uploadimagem(Produto $produto) {
        $prd = Produto::find($produto->id);

        $lista_produto = ProdutoImagem::where('produto_id', $produto->id)->get();

        return view('admin.produtos.upload', ['produto_imagem' => $lista_produto, 'produto' => $prd,]);
    }

    public function getproduto($produto, Request $request) {
        //$prd = Produto::where('nome',$produto)->first();
        $prd = $this->produtos->getbyNome($produto);
        return Response()->json($prd);
        //($this->produtos->getbyNome($produto));
    }

    public function getprodutoImagem($produto) {
        //$prd = Produto::where('nome',$produto)->first();
        //$prd = $this->produtos->getbyNome($produto);
        $prdImg = Produto_Imagem::where('produto_id', $produto)->get();
        return Response()->json($prdImg);
        //($this->produtos->getbyNome($produto));
    }

    public function saveUpload(Request $request) {
        $file = $request->campoimagem;
        
        if (!is_null($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName(); //getBasename();
            $exists = Storage::disk('root')->exists($filename);
            if (!$exists) {
                Storage::disk('root')->put($filename . '.' . $extension, File::get($file));
            }

            $produto_Imagem = new ProdutoImagem();
            $produto_Imagem->produto_id = $request->produtoid;
            $produto_Imagem->caminho = $filename . '.' . $extension;
            $produto_Imagem->descricao = $request->descricao;

            $produto_Imagem->save();
        }
        
        $prd = Produto::find($request->produtoid);

        $lista_produto = Produto_Imagem::where('produto_id', $request->produtoid)->get();

        return view('admin.produtos.upload', ['produto_imagem' => $lista_produto, 'produto' => $prd,]);
    }

    public function destroyprodutoimagem(Request $request, Produto_Imagem $produto) {
        $this->authorize('destroyprodutoimagem', $produto);

        $produto_Imagem = Produto_Imagem::find($produto->id);

        $prd = Produto::find($produto_Imagem->produto_id);

        $ProdutoId = $produto_Imagem->produto_id;

        $exists = Storage::disk('root')->exists($produto_Imagem->caminho);
        if ($exists) {
            Storage::disk('root')->delete($produto_Imagem->caminho);
        }

        $produto_Imagem->delete();

        $lista_produto = Produto_Imagem::where('produto_id', $ProdutoId)->get();

        return view('admin.produtos.upload', ['produto_imagem' => $lista_produto, 'produto' => $prd,]);
        //return 'teste de retorno';
    }

    public function getToken() {
        $token = csrf_token();
        return Response()->json(['token' => $token]);
    }

}
