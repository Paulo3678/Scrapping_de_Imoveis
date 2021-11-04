<?php

namespace App\Http\Controllers;

use App\Http\Entity\Cidades;
use Illuminate\Http\Request;
use App\Http\Helper\Buscas\BuscaDadosMovingImoveis;
use App\Http\Helper\EntityManagerFactory;

class PaginaInicial extends Controller
{
    private $em;
    public function __construct()
    {
        $this->em = (new EntityManagerFactory())->getEntityManager();
    }

    public function index()
    {
        $estados = [
            "AC", "AL", "AP", "AM", "BA", "CE", "DF",
            "ES", "GO", "MA", "MT", "MS", "MG", "PA",
            "PB", "PR", "PE", "PI", "RJ", "RN", "RS",
            "RO", "RR", "SC", "SP", "SE", "TO",
        ];
        return view('rotas.pagina-inicial', compact("estados"));
    }

    public function create(Request $request)
    {
        $municipioPost = $request->get('municipio');
        /** @var Cidades @municipio */
        $municipio = $this->em->getRepository(Cidades::class)->findOneBy(["municipio" => $municipioPost]);

        if (empty($municipio)) {
            session()->flash('message', 'Cidade inexistente!!');
            return redirect()->route("inicio");
        }

        $movingImoveis = new BuscaDadosMovingImoveis(strtolower($municipio->getSigla()), strtolower($municipio->getMunicipio()));
        $dados = $movingImoveis->dadosCompletos();

        $request->session()->put("dadosPesquisa", $dados);
        return redirect("/pagina-inicial");
    }
}
