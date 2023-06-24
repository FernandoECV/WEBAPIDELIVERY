<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Municipio;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
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

    public function consultarMunicipios()
    {
        $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/RJ/municipios';

        // Desabilitar temporariamente a verificação do certificado SSL
        stream_context_set_default(
            array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ),
            )
        );

        // Realizar a chamada para a API do IBGE
        $response = file_get_contents($url);

        if ($response !== false) {
            $municipios = json_decode($response, true);

            // Percorre os municípios e insere-os na tabela associada a ele
            foreach ($municipios as $municipio) {
                // Verifica se o município já existe no banco de dados antes de inseri-lo novamente
                $existeMunicipio = Municipio::where('ibge_id', $municipio['id'])->first();

                if(!$existeMunicipio) {
                    Municipio::create([
                        'ibge_id' => $municipio['id'],
                        'ibge_name' => $municipio['nome']
                    ]);
                }
            }

            return response()->json(['message' => 'Municipios consultados e salvos com sucesso'], 200);
        }

        return response()->json(['error' => 'Erro ao consultar os municípios'], 500);
    }
}
