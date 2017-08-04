<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{    
    protected $categorias;
   
    
    public function __construct() {
        $this->middleware('auth');
        
        $this->categorias = Categoria::all();
    }

    
    public function index() {
        return view('admin.categorias.index', [
            'categorias' => $this->categorias,           
        ]);
    }

    public function edit(categoria $categoria) {
        $ctg = categoria::find($categoria->id);
        
        return view('admin.categorias.edit', [
            'categoria' => $ctg,
            'categorias' => $this->categorias,            
        ]);
    }

    public function update(Request $request, categoria $categoria) {
        $this->validate($request, [
            'nome' => 'required|max:255',
            
        ]);
                     
        $categoria_update->nome = $request->nome;        
        
        
        $categoria_update->save();
        
        $request->session()->flash('status', 'categoria alterada com sucesso!');
        
        return redirect('/admin/categorias');
    }

    /**
     * Create a new categoria.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'nome' => 'required|max:255',
           
        ]);
        
        
                                
        $categoria = new categoria([
            'nome' => $request->nome,        
            
        ]);

        $categoria->save();
        
        $request->session()->flash('status', 'categoria cadastrada com sucesso!');

        return redirect('/admin/categorias');
    }

    /**
     * Destroy the given categoria.
     *
     * @param  Request  $request
     * @param  categoria  $categoria
     * @return Response
     */
    public function destroy(Request $request, categoria $categoria) {
        //$this->authorize('destroy', $categoria);
        categoria::destroy($categoria->id);
        $request->session()->flash('status', 'categoria excluída com sucesso!');
        
        return redirect('/admin/categorias');
    }
      
    public function getToken() {
        $token = csrf_token();
        return Response()->json(['token' => $token]);
    }
}
