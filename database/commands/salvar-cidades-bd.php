<?php

use App\Http\Entity\Cidades;
use App\Http\Helper\EntityManagerFactory;

require_once __DIR__ . "/../../vendor/autoload.php";

$em = (new EntityManagerFactory())->getEntityManager();

$dados = json_decode(file_get_contents("https://servicodados.ibge.gov.br/api/v1/localidades/distritos"), true);

foreach ($dados as $dado) {
    $cidade = new Cidades();
    $cidade->setMunicipio($dado['municipio']['nome'])
        ->setEstado($dado['municipio']['microrregiao']['mesorregiao']['UF']['nome'])
        ->setSigla($dado['municipio']['microrregiao']['mesorregiao']['UF']['sigla']);
    $em->persist($cidade);
}
$em->flush();
