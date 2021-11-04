<?php

namespace App\Http\Helper\Buscas;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;

class BuscaBase
{
    private $url;

    public function __construct(string $estado, string $cidade)
    {
        $this->url = "https://www.movingimoveis.com.br/venda-{$estado}-" . str_replace(" ", "-", strtolower($this->removeAcentos($cidade)));
    }

    public function buscar(string $parametroDeBusca)
    {
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $this->url);

        $retorno = $crawler->filter($parametroDeBusca)->each(function ($node) {
            return $node->text();
        });

        return $retorno;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function buscarPreco()
    {
        return $this->buscar('p[class=realty-price]');
    }

    public function buscaLocal()
    {
        return $this->buscar('p[class="neighborhood-name"]');
    }

    public function buscaDetalhesLocal()
    {
        return $this->buscar('p[class="realty-details"]');
    }

    public function buscaDescricao()
    {
        return $this->buscar('h2[class="three-lines"]');
    }

    public function buscarPaginaImovel()
    {
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $this->url);

        $retorno = $crawler->filter('a[style="text-decoration: none;color: black; outline: none"]')->each(function ($node) {
            // Pega o conteudo da tag href
            /** @var Crawler $node */
            return "https://www.movingimoveis.com.br" . $node->attr('href');
        });

        return $retorno;
    }

    public function buscarUrlImagems()
    {

        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', $this->url);

        $retorno = $crawler->filter('img[data-lazy]')->each(function ($node) {
            // Pega o conteudo da tag href
            /** @var Crawler $node */
            return $node->attr('data-lazy');
        });
        return $retorno;
    }




    protected function removeAcentos(string $string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }
}
