<?php

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;

require_once __DIR__ . "/vendor/autoload.php";

$browser = new HttpBrowser(HttpClient::create());
$crawler = $browser->request('GET', "https://www.movingimoveis.com.br/venda-mg-itajuba");

$retorno = $crawler->filter('img[data-lazy]')->each(function ($node) {
    // Pega o conteudo da tag href
    /** @var Crawler $node */
    return $node->attr('data-lazy');
});
return $retorno;