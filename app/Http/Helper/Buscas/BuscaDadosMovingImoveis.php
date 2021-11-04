<?php

namespace App\Http\Helper\Buscas;

use App\Http\Helper\Buscas\BuscaBase;

class BuscaDadosMovingImoveis extends BuscaBase
{
    public function dadosCompletos(): array
    {
        $local = $this->buscaLocal();
        $preco = $this->buscarPreco();
        $descricao = $this->buscaDescricao();
        $paginaImovel = $this->buscarPaginaImovel();
        $imgsSrc = $this->buscarUrlImagems();


        $retorno = [];

        $inicioFor = 0;

        $menorQueFor = 3;
        $valorFinal = 0;

        for ($i = 0; $i < count($local); $i++) {
            $imagems = [];
            for ($j = $inicioFor; $j < $menorQueFor; $j++) {
                $imagems[] = $imgsSrc[$j];
                $valorFinal = $i;
            }
            $inicioFor = $valorFinal;
            $menorQueFor = $valorFinal + 3;

            $retorno[] = [
                "local" => $local[$i],
                "preco" => $preco[$i],
                "descricao" => $descricao[$i],
                "paginaImovel" => $paginaImovel[$i],
                "imagems" => $imagems
            ];
        }

        return $retorno;
    }
}
