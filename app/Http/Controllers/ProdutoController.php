<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/produtos');
    }

    public function listaProdutos() 
    {
        $aProdutos = \App\Produto::all();
        if (empty($aProdutos)) {
            return view('produto.lista', ['aProdutos' => $aProdutos]);
        }
        return view('produto.lista', ['aProdutos' => $aProdutos]);
    }

    public function cadastrarProduto(Request $request) 
    {
        $oProduto = new \App\Produto();
        $iExisteProd = DB::table('produtos')
                            ->where('prod_desc', $request->get('prod_desc'))
                            ->count();
        if ($iExisteProd == 0) {
            $oProduto->prod_desc = $request->get('prod_desc');
            $oProduto->prod_valo = $request->get('prod_valo');
            $oProduto->save();

            return $this->listaProdutos();
        }

        return redirect('/cadastrar')->with('error', 'Produto já existe.');
    }
}
