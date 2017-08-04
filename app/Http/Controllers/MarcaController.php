<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    protected $marcas;
   
    
    public function __construct() {
        $this->middleware('auth');
        
        $this->marcas = Marca::all();
    }

    
    public function index() {
        return view('admin.marcas.index', [
            'marcas' => $this->marcas,           
        ]);
    }

    public function edit(Marca $marca) {
        $mrc = Marca::find($marca->id);
        
        return view('admin.marcas.edit', [
            'marca' => $mrc,
            'marcas' => $this->marcas,            
        ]);
    }

    public function update(Request $request, marca $marca) {
        $this->validate($request, [
            'nome' => 'required|max:255',
            
        ]);
                     
        $marca_update->nome = $request->nome;        
        
        
        $marca_update->save();
        
        $request->session()->flash('status', 'marca alterada com sucesso!');
        
        return redirect('/admin/marcas');
    }

    /**
     * Create a new marca.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'nome' => 'required|max:255',
           
        ]);
                                              
        $marca = new marca([
            'nome' => $request->nome,        
            
        ]);

        $marca->save();
        
        $request->session()->flash('status', 'marca cadastrada com sucesso!');

        return redirect('/admin/marcas');
    }

    /**
     * Destroy the given marca.
     *
     * @param  Request  $request
     * @param  marca  $marca
     * @return Response
     */
    public function destroy(Request $request, marca $marca) {
        //$this->authorize('destroy', $marca);
        marca::destroy($marca->id);
        $request->session()->flash('status', 'marca excluída com sucesso!');
        
        return redirect('/admin/marcas');
    }
      
    public function getToken() {
        $token = csrf_token();
        return Response()->json(['token' => $token]);
    }
}
