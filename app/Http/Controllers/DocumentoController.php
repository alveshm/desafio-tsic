<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        return view('/vendas');
    }

    public function gerenciaVenda(Request $request) 
    {
        
        $oProduto = $this->buscaProduto($request->get('busca'));
        $iCodiDocu = $request->get('codiDocu');
        $aProduto = $oProduto->toArray();
        if ($this->buscaProduto($request->get('busca'))->count() > 0 && !$this->existeDocumento($iCodiDocu)) {            
                $this->cadastrarDocumento($iCodiDocu);
                if ($aProduto[0]->id) {
                    $this->cadastrarItem($aProduto[0]->id, $iCodiDocu);
                }
                
                return view('documento.documento', ['aProdutos' => $this->buscaProdutosVenda($iCodiDocu), 'codigo' => $iCodiDocu]);
        }else {
            if ($this->buscaProduto($request->get('busca'))->count() == 0) {
                return view('documento.documento', ['aProdutos' => $this->buscaProdutosVenda($iCodiDocu), 'codigo' => $iCodiDocu, 'error' => 'Nenhum produto cadastrado com este código!']);
            }else {
                if (!empty($aProduto)) {
                    $this->cadastrarItem($aProduto[0]->id, $iCodiDocu);
                }
                return view('documento.documento', ['aProdutos' => $this->buscaProdutosVenda($iCodiDocu), 'codigo' => $iCodiDocu]);
            }   
        }
        
    }

    public function buscaProduto($iProduto)
    {
        $oProduto = DB::table('produtos')
                            ->where('id', $iProduto)
                            ->get();
        
        return $oProduto;
    }

    public function buscaCodigo()
    {
        $iCodi = DB::table('documentos')->max('id');
        
        if (empty($iCodi)) {
            return view('documento.documento', ['codigo' => $iCodi += 1]);
        } 
        return view('documento.documento', ['codigo' => $iCodi += 1]);
    }

    public function cadastrarItem($iProduto, $iDocumento)
    {
        $oItem = new \App\Item();

        $oItem->item_docu = $iDocumento;
        $oItem->item_prod = $iProduto;

        $oItem->save();
    }

    public function cadastrarDocumento($id)
    {
        $oDocumento = new \App\Documento();
        $oDocumento->docu_tota = 1;
        $oDocumento->save();
    }

    public function existeDocumento($id)
    {
        $existeDocu = \App\Documento::find($id);
        return !empty($existeDocu) ? true : false;
    }

    public function buscaProdutosVenda($iIdDocu)
    {
        $aItems = DB::table('items')
                            ->where('item_docu', $iIdDocu)
                            ->get();
        $aTodosProdutos = array(); 
        
          
        foreach ($aItems as $oProduto) {
            $aTodosProdutos[] = $this->buscaProduto($oProduto->item_prod);
        }
        return Collection::make($aTodosProdutos);
    }

    public function buscaDocumento($iIdDocu)
    {
        $oDocu = DB::table('documentos')
                            ->where('id', $iIdDocu)
                            ->get();

        return $oDocu;
    }

    public function finalizarDocumento(Request $request) 
    {
        if (!empty($request->get('confirmar'))) {
            if (!empty($request->get('codiDocuAtualizar'))) {
                $oDocu = \App\Documento::where('id', $request->get('codiDocuAtualizar'))
                        ->update(['docu_conf' => 'S']);
            }
        }

        return redirect('/vendas');
    }
}
