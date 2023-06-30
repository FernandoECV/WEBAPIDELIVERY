<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        // Retorna a lista de produtos como resposta JSON
        if (request()->wantsJson()) {
            return response()->json($produtos);
        }

        // Retorna a lista de produtos na view
        return view('produtos.index', compact('produtos'));

        $produtos = Produto::all();
        // Retorna a lista de produtos como resposta JSON
        // return response()->json($produtos);
    }

    public function store(Request $request)
    {
        $produto = Produto::create($request->all());
        return response()->json($produto, 201,);
    }

    public function show(Produto $produto)
    {
        return response()->json($produto);
    }

    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return response()->json($produto);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(null, 204);
    }
}
