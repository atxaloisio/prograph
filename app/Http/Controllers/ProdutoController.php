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
use Illuminate\Http\JsonResponse;

class ProdutoController extends Controller {

    /**
     * The produto repository instance.
     *
     * @var TaskRepository
     */
    protected $produtos;

    /**
     * Create a new controller instance.
     *
     * @param  ProdutoRepository  $produtos
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');

        $this->produtos = Produto::all();
    }

    /**
     * Display a list of all of the user's produto.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request) {
        return view('admin.produtos.index', [
            'produtos' => $this->produtos,
        ]);
    }

    public function edit(Request $request, Produto $produto) {
        $prd = Produto::find($produto->id);
        return view('admin.produtos.edit', [
            'produto' => $prd,
            'produtos' => $this->produtos,
        ]);
    }

    public function update(Request $request, Produto $produto) {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'descricao' => 'required|max:255',
        ]);

        $produto_update = Produto::find($produto->id);
        $produto_update->nome = $request->nome;
        $produto_update->descricao = $request->descricao;

        $produto_update->save();

        //Session::flash('message', 'Successfully updated produto!');

        $request->session()->flash('status', 'produto was successful!');
        $this->produtos = Produto::all();
        return view('admin.produtos.index', ['produtos' => $this->produtos,]);
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
            'descricao' => 'required|max:255',
        ]);

        $produto = new Produto([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        $produto->save();

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
